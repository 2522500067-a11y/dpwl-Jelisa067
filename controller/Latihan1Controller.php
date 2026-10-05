<?php

class Latihan1Controller extends Controller
{
    public function index()
    {
        $data['datamhs'] = $this->load->model('Latihan1Model')->getAllMhs();
        $this->load->view('latihan1view', $data);
    }
}