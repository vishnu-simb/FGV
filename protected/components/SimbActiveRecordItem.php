<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/27/14
 * Time: 10:22 AM
 *
 * Common Active Record for database object item
 */
class SimbActiveRecordItem extends SimbActiveRecord
{
    /**
     * Before saving item, set the created and updated time using gmt
     * @return bool|void
     */
    public function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                if (!$this->getAttribute('created_at')) $this->setAttribute('created_at', gmdate('Y-m-d H:i:s'));
            }
            if (!$this->getAttribute('updated_at')) $this->setAttribute('updated_at', gmdate('Y-m-d H:i:s'));

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array, scope array for the item
     */
    public function scopes()
    {
        return CMap::mergeArray(
            parent::scopes(),
            array(
                // only not deleted items
                'not_deleted' => array(
                    'condition' => $this->tableAlias.'.is_deleted = :is_deleted',
                    'params' => array(':is_deleted' => 0),
                ),

            )
        );
    }
}