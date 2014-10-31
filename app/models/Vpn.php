<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 24/10/14
 * Time: 12:29 PM
 */




class Vpn extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'vpn_login';
    protected $primaryKey = 'vplo_id_login';
    public $timestamps = false;

}