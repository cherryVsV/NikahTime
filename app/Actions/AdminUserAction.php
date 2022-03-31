<?php


namespace App\Actions;


use TCG\Voyager\Actions\AbstractAction;

class AdminUserAction extends AbstractAction
{
    public function getTitle()
    {
        return $this->data->{'role_id'}==2?'Пользователь':'Администратор';
    }
    public function getIcon()
    {
        return $this->data->{'role_id'}==2?'voyager-check':'voyager-x';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }
    public function getDefaultRoute()
    {
        // URL-адрес для кнопки действия при нажатии кнопки
        return route('users.admin', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
}
