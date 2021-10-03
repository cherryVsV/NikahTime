<?php


namespace App\Actions;


use TCG\Voyager\Actions\AbstractAction;

class BlockUserAction extends AbstractAction
{
    public function getTitle()
    {
        return $this->data->{'blocked_at'}==null?'Заблокировать':'Разблокировать';
    }
    public function getIcon()
    {
        return $this->data->{'blocked_at'}==null?'voyager-x':'voyager-check';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-left',
        ];
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }
    public function getDefaultRoute()
    {
        // URL-адрес для кнопки действия при нажатии кнопки
        return route('users.block', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
}
