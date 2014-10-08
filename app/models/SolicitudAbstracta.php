<?php


class SolicitudAbstracta extends Eloquent {

    protected $fillable = [];

    protected $table = 'solicitud_abstracta';
    protected $primaryKey = 'SOAB_ID_SOLICITUD_ABSTRACTA';
    public $timestamps = false;
    protected $with = array('MedioComunicacion');

    public function cuentascol()
    {
        return $this->hasMany('Cuentacol', 'soco_id_solicitud_abstracta');
    }

    public function otraaplicacion()
    {
        return $this->hasMany('OtraAplicacion', 'otap_id_solicitud_abstracta');
    }


    public function grado()
    {
        return $this->hasOne('Grado');
    }

    public function mediocomunicacion()
    {
        return $this->belongsTo('MedioComunicacion', 'soab_id_medio_comunicacion', 'meco_id_medio_comunicacion');
    }


    public function lineaespecializacion()
    {
        return $this->belongsTo('LineaEspecializacion', 'soab_ide_linea_especializacion', 'lies_ide_linea_especializacion');
    }

    public function modelocomputacional()
    {
        return $this->belongsTo('ModeloComputacional', 'soab_id_modelo', 'moco_id_modelo');
    }


    public function aplicaciones()
    {


        return $this->belongsToMany('Aplicacion', 'solicitud_x_app', 'soap_id_solicitud_abstracta', 'soap_id_aplicacion');
    }
}