<?php

/**
 * BWLabFields Model for CK form Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

/**
 * BWLabFields Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class BWLabFormsModelBWLabForms extends JModel {

    public function getData() {

        return $this->getDbo()
                        ->setQuery('select * from #__bwlabforms order by id')
                        ->loadObjectList();
    }

    /**
     * duplicate form in new form
     * @param type $pk 
     */
    public function duplicateForm($pk) {


        $old_form = $this->getTable('BWLabForm');
        $old_form->load($pk);
        $old_form->set('id', null);
        $old_form->store();

        return $old_form; //$this->getDbo()->setQuery($query)->query();
    }

    public function getFields($fid) {

        return $this->getDbo()
                        ->setQuery('select * from #__bwlabfields where fid = ' . $fid)
                        ->loadObjectList();
    }

    public function getFieldNumber($fid) {

        return $this->getDbo()
                        ->setQuery('select count(id) as fieldnumber from #__bwlabfields where fid = ' . $fid)
                        ->loadRow();
    }

    /**
     * generate table 
     * @param int $fid
     * @return boolean
     * @throws JException 
     */
    public function generateTable($fid) {

        $form = $this->getTable('BWLabForm');

        $form->load($fid);

        /**
         * [nomecampo] = tipo
         * @var array 
         */
        $cols = $this->getDbo()->getTableColumns('#__' . $form->name);

        $sqlfields = array();

        $fields = $this->getFields($fid);

        if (empty($cols)) {
//            create table
            foreach ($fields as $field) {

                $sqlfields[] = $field->name . " text";
            }

            if (count($sqlfields) == 0)
                throw new JException('There are no fields to generate');

            $this->getDbo()->setQuery(
                    $this->createTable(
                            $form->name, $sqlfields
                    )
            )->query();
        } else {
//            alter table
            foreach ($fields as $field) {

                if ($cols[$field->name] === null) {

                    $sqlfields[] = $field->name . " text";
                }
            }

            if (count($sqlfields) == 0)
                throw new JException('There are no  new fields to add');;

            $this->getDbo()->setQuery(
                    $this->alterTable($form->name, $sqlfields)
            )->query();
        }

        return true;
    }

    private function createTable($table, $fields) {

        return sprintf(
                        'create table #__' . $table . "( id int(11), %s , primary key (id) ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;", implode(',', $fields)
        );
    }

    private function alterTable($table, $fields) {

        return sprintf(
                        'alter table #__' . $table . " add ( %s )", implode(',', $fields)
        );
    }

    public function dropTable($fid) {

        $form = $this->getTable('BWLabForm');

        $form->load($fid);

        $this->getDbo()
                ->setQuery('drop table #__' . $form->name)
                ->query();
        
    }

}

