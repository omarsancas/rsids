<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 14/10/14
 * Time: 05:08 PM
 */




class OtroCampo extends Eloquent {
    
    protected $fillable = array('otca_id_otro_campo','otca_nombre');
    protected $table = 'otro_campo';
    protected $primaryKey = 'OTCA_ID_OTRO_CAMPO';
    public $timestamps = false;

}