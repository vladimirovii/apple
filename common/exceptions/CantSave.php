<?php

namespace common\exceptions;

use yii\base\Exception;
use yii\db\ActiveRecord;

class CantSave extends Exception
{
    /**
     * @var mixed model errors
     */
    protected $errors;

    /**
     * @var mixed model attributes
     */
    protected $attributes;

    public function __construct(ActiveRecord $model, $message = '', $code = 0, \Exception $previous = null)
    {
        $this->errors = $model->getErrors();
        $this->attributes = $model->getAttributes();
        \Exception::__construct(
            'Can\'t save ' . get_class($model) . ': ' . print_r($this->errors, true) .
            'Attributes: ' . print_r($this->attributes, true),
            $code,
            $previous
        );
    }
}
