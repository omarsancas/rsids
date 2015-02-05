<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/02/15
 * Time: 10:41 PM
 */



class Convocatoria extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'convocatoria';
    protected $primaryKey = 'CONVO_ID';
    public $timestamps = false;

}