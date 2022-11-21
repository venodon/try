<?php

use Fuel\Core\Validation;
use Orm\Model;

/**
 * @property $title
 * @property $preview
 * @property $body
 * @property $status
 * @property $created_at
 * @property $updated_at
 */
class Model_Post extends Model
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    const STATUS_LIST = [
       self::STATUS_DISABLED => 'Отключено',
       self::STATUS_ACTIVE => 'Опубликовано',
    ];

    /**
     * @param int $status
     * @return string
     */
    public function getStatusName(int $status): string
    {
        return self::STATUS_LIST[$status]??'';
    }

	protected static $_properties = array(
		'id',
		'title',
		'preview',
		'body',
		'status',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('preview', 'Preview', 'required|max_length[250]');
		$val->add_field('body', 'Body', 'required');
		$val->add_field('status', 'Status', 'required|valid_string[numeric]');

		return $val;
	}

}
