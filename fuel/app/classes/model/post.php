<?php

/**
 * @property $title
 * @property $preview
 * @property $body
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property Model_Category $category
 */
class Model_Post extends \Orm\Model
{
    public $views; //просмотры

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
        return self::STATUS_LIST[$status] ?? '';
    }

    protected static $_properties = array(
        'id',
        'title',
        'preview',
        'body',
        'status',
        'category_id',
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
        'Observer_Views' => [
            'events' => ['after_load']
        ]
    );

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('title', 'Заголовок', 'required|max_length[255]');
        $val->add_field('preview', 'Превью', 'required|max_length[250]');
        $val->add_field('body', 'Текст', 'required');
        $val->add_field('status', 'Статус', 'required|valid_string[numeric]');

        return $val;
    }

    /**
     * @var string[][]
     */
    protected static $_belongs_to = [
        'category' => [
            'model_to' => 'Model_Category',
            'key_from' => 'category_id',
            'key_to' => 'id',
        ]
    ];

}
