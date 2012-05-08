<?php
class AppModel extends Model {
    /**
     * This will upload a file to the given directory.
     * 
     * @param array $file The POST file array created by PHP
     * @param string $folder The folder relative to the WWW_ROOT
     * @return string The name of the file for use in saving in your database
     */
    public function uploadFile($file, $folder) {
        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');

        $file_path = WWW_ROOT . DS . $folder;
        $name = time() . '_' . $file['name'];

        new Folder($file_path, true, 0755);

        $tmp_file = new File($file['tmp_name']);
        $tmp_file->copy($file_path . DS . $name);
        
        return $name;
    }
    
    /**
     * Delete the file currently saved for a particular database entry
     * 
     * @param string $file The full name (but not path) of the current file
     * @param string $folder The folder the file is in relative to WWW_ROOT
     * @return boolean The status of deleting the file 
     */
    public function deleteExistingFile($file, $folder) {
        App::uses('File', 'Utility');
        
        $file_path = WWW_ROOT . DS . $folder;
        $existing = new File($file_path . $file);
        
        return $existing->delete();
    }
    
    /**
     * Change a user's status.
     * 
     * @param int $id Model id
     * @param boolean $status True for active, false for inactive
     * @return boolean The result of saving the change
     */
    public function changeStatus($id, $status = null) {
        $this->id = $id;
        
        if (is_null($status)) {
            $status = !$this->field('status');
        } elseif (!is_bool($status)) {
            trigger_error('status must be boolean or null');
            return;
        }
        
        return $this->saveField('status', $status);
    }
    
    /**
     * Uses the given search term to try and match a date within the model
     * 
     * @param string $searchTerm This is the term being searched for.
     * @param boolean $error (true) Display an error for the search.
     * @return array The conditions statement for use with model->find 
     */
    protected function dateSearch($searchTerm, $error = true) {
        $conditions = array();
        $model = $this->alias;
            
        if (is_numeric($searchTerm)) {
            $conditions = array(
                'OR' => array(
                    "DATE_FORMAT($model.date, '%Y')" => $searchTerm,
                    "DATE_FORMAT($model.date, '%y')" => $searchTerm
                )
            );
            if ($searchTerm <= 31) {
                $conditions['OR']["DATE_FORMAT($model.date, '%m')"] = $searchTerm;

                if ($searchTerm <= 12) {
                    $conditions['OR']["DATE_FORMAT($model.date, '%d')"] = $searchTerm;
                }
            }
        } elseif (preg_match('/^\w+$/', $searchTerm)) {
            $conditions = array(
                'OR' => array(
                    "DAYNAME($model.date)" => $searchTerm,
                    "MONTHNAME($model.date)" => $searchTerm
                )
            );
        } else {
            try {
                $date = new DateTime($searchTerm);
                if (preg_match("/^(\d{1,2}.\d{4}|\w+.\d{4})$/U", $searchTerm)) {
                    $conditions = array(
                        "$model.date BETWEEN ? AND ?" => array(
                            $date->format('Y-m-01'),
                            $date->format('Y-m-t')
                        )
                    );
                } elseif (preg_match("/^(\d{1,2}.\d{1,2}|\w+.\d{1,2})$/U", $searchTerm)) {
                    $conditions = array(
                        "DATE_FORMAT($model.date, '%m-%d')" => $date->format('m-d')
                    );
                } else {
                    $conditions = array(
                        "$model.date" => $date->format('Y-m-d')
                    );
                }
            } catch (Exception $e) {
                if ($error === TRUE) {
                    $this->invalidate('Search', 'The search term could not be converted to a date');
                }
            }
        }
        
        return $conditions;
    }
}