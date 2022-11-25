<?php
use Orm\Model;

class Model_Category extends Model
{
	protected static $_properties = array(
		'id',
		'title',
		'sort',
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
		$val->add_field('sort', 'Sort', 'required|valid_string[numeric]');
		$val->add_field('status', 'Status', 'required|valid_string[numeric]');

		return $val;
	}

    protected static $_has_many = [
        'posts' => [
            'model_to' => 'Model_Post',
            'key_from' => 'id',
            'key_to' => 'category_id',
        ]
    ];
}
