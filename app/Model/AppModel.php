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
}