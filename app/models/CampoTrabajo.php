<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 14/10/14
 * Time: 05:12 PM
 */

class CampoTrabajo extends Eloquent{

    protected $fillable = array('catr_id_campo_trabajo','catr_nombre_campo');
    protected $table = 'campo_trabajo';
    protected $primaryKey = 'catr_id_campo_trabajo';
    public $timestamps = false;



}