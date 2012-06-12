<?php
/**
 * @property Report $Report 
 */
class ReportCategory extends AppModel {
    public $name = 'ReportCategory';
    
    public $hasMany = 'Report';
}
