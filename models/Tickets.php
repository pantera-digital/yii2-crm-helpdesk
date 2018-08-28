<?php

namespace pantera\helpdesk\models;

use Yii;

/**
 * This is the model class for table "{{%tickets}}".
 *
 * @property int $id
 * @property string $user_id User identity
 * @property string $subject Ticket theme
 * @property string $email User e-mail
 * @property string $name User name
 * @property int $status Ticket status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TicketMessages[] $messages
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tickets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['subject', 'email', 'name', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject', 'email', 'name'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketMessages::className(), 'targetAttribute' => ['id' => 'ticket_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User identity',
            'subject' => 'Ticket theme',
            'email' => 'User e-mail',
            'name' => 'User name',
            'status' => 'Ticket status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(TicketMessages::className(), ['ticket_id' => 'id']);
    }
}
