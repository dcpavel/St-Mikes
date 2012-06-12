<?php
/**
 * @property ReportCategory $ReportCategory
 */
class Report extends AppModel {
    public $name = 'Report';
    
    public $belongsTo = 'ReportCategory';
}