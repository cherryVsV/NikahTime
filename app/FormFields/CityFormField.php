<?php


namespace App\FormFields;
use TCG\Voyager\FormFields\AbstractHandler;

class CityFormField extends AbstractHandler
{
    protected $codename = 'address';
    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor.voyager.formfields.addressformfield', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
