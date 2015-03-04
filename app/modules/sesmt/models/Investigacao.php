<?php

class Investigacao extends Eloquent {
    protected $guarded = [];
    protected $filllabel = [];
    protected $table = 'sesmt_investigacaos';

    public function ocorrencias(){
        return $this->hasOne('Ocorrencia', 'id');
    }
}