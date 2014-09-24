<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 19/09/14
 * Time: 12:13 AM
 */




class LineaEspecializacion extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'linea_especializacion';
    protected $primaryKey = 'lies_ide_linea_especializacion';
    public $timestamps = false;


    public function proyecto()
    {
        return $this->hasOne('Proyecto','soab_ide_linea_especializacion','lies_ide_linea_especializacion');
    }

}