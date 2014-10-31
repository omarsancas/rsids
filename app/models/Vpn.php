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
    protected $primaryKey = 'VPLO_ID_VPN_LOGIN';
    public $timestamps = false;

}