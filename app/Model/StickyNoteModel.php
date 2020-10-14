<?php

namespace Kanboard\Model;

use Kanboard\Core\Base;

/**
 * Column Model
 *
 * @package  Kanboard\Model
 * @author   Frederic Guillot
 */
class StickyNoteModel extends Base
{
    /**
     * SQL table name
     *
     * @var string
     */
    const TABLE = 'sticky_note';

    /**
     * Get a column by the id
     *
     * @access public
     * @param  integer  $column_id    Column id
     * @return array
     */
    public function getById($column_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $column_id)->findOne();
    }

    /**
     * Get a column title by the id
     *
     * @access public
     * @param  integer  $column_id
     * @return integer
     */
    public function getColumnContentById($column_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $column_id)->findOneColumn('content');
    }

    public function getAll($user_id)
    {
        return $this->db->table(self::TABLE)->eq('user_id', $user_id)->desc('id')->findAll();
    }

    public function create($user_id, $content)
    {
        $values = array(
            'user_id' => $user_id,
            'content' => $content,
        );
        return $this->db->table(self::TABLE)->persist($values);
    }

    public function update($column_id, $content)
    {
        return $this->db->table(self::TABLE)->eq('id', $column_id)->update(array(
            'content' => $content,
        ));
    }

    /**
     * Remove a column and all tasks associated to this column
     *
     * @access public
     * @param  integer  $column_id    Column id
     * @return boolean
     */
    public function remove($column_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $column_id)->remove();
    }

    public function noteEvents ($user_id = null, $limit = null)
    {
        if (!$user_id) {
            $user_id = $this->userSession->getId();
        }
        if (!$limit) {
            return $this->getAll($user_id);
        }
        return $this->db->table(self::TABLE)->limit($limit)->desc('id')->eq('id', $user_id)->findAll();
    }
}
