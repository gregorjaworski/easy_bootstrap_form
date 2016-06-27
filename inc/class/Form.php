<?php
namespace Wsph\Ebf;

/**
 * Description of Form
 *
 * @author grzegorz
 */
class Form {

    private $default_form;
    private $form;

    public function __construct() {

        $this->default_form = '<div id="default-ebf"> <div id="result"></div> <div class="form-group col-xs-12"> <label class="sr-only" for="exampleInputAmount">Name</label>  <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user"></i></div> <input type="text" class="form-control" name="name" placeholder="' . __('Type Your name', 'wsph_ebf') . '" /> </div> <small id="nameDanger" class="text-danger"></small> </div> <div class="form-group col-lg-6 col-xs-12"> <label class="sr-only" for="exampleInputAmount">Email</label> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-envelope"></i></div> <input type="email" class="form-control" name="email" placeholder="' . __('Your email...', 'wsph_ebf') . '" /> </div> <small id="mailDanger" class="text-danger"></small> </div> <div class="form-group col-lg-6 col-xs-12"> <label class="sr-only" for="exampleInputAmount">Phone</label> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone-square"></i></div> <input type="tel" class="form-control" name="phone" placeholder="' . __('...or phone number', 'wsph_ebf') . '" /> </div> <small id="phoneDanger" class="text-danger"></small> </div> <div class="form-group col-xs-12"> <label class="sr-only" for="exampleInputAmount">Message</label> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div> <textarea class="form-control" rows="5" name="message" placeholder="' . __('Messege', 'wsph_ebf') . '" ></textarea> </div> <small id="messageDanger" class="text-danger"></small> </div> <div class="form-group  text-xs-right"> <button id="wsph_ebf_submit_btn" type="submit" class="btn btn-danger m-r-2"><i class="fa fa-paper-plane-o btn-icon-l p-r-2"></i>' . __('Send', 'wsph_ebf') . '</button> </div> </div>';
    }

    public function get_form($id = 'default') {
        switch ($id){
            case 'default':
                $this->form = $this->default_form;
                break;
            
            case 'front-form':
                $this->form = '<section id="contact" class="flex-vcenter p-t-4 p-b-2"> <div class="container flex-vcenter-wrap  col-xl-8 col-xl-offset-2 col-xs 12 text-xs-center"> <div class="row center-block"> <div class="service-content-titel col-xs-12"><h1 class="contact-form-titel">' . __('Chętnie odpowiem na Państwa pytanie.', 'wsph_ebf') . '</h1> </div></div> <div id="front-contact-form"> <div id="result"></div> <div class="form-group col-xs-12"> <label class="sr-only" for="exampleInputAmount">Name</label>  <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user"></i></div> <input type="text" class="form-control" name="name" placeholder="' . __('Type Your name', 'wsph_ebf') . '" /> </div> <small id="nameDanger" class="text-danger"></small> </div> <div class="form-group col-lg-6 col-xs-12"> <label class="sr-only" for="exampleInputAmount">Email</label> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-envelope"></i></div> <input type="email" class="form-control" name="email" placeholder="' . __('Your email...', 'wsph_ebf') . '" /> </div> <small id="mailDanger" class="text-danger"></small> </div> <div class="form-group col-lg-6 col-xs-12"> <label class="sr-only" for="exampleInputAmount">Phone</label> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone-square"></i></div> <input type="tel" class="form-control" name="phone" placeholder="' . __('...or phone number', 'wsph_ebf') . '" /> </div> <small id="phoneDanger" class="text-danger"></small> </div> <div class="form-group col-xs-12"> <label class="sr-only" for="exampleInputAmount">Message</label> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div> <textarea class="form-control" rows="5" name="message" placeholder="' . __('Messege', 'wsph_ebf') . '" ></textarea> </div> <small id="messageDanger" class="text-danger"></small> </div> <div class="form-group  text-xs-right"> <button id="wsph_ebf_submit_btn" type="submit" class="btn btn-danger m-r-2"><i class="fa fa-paper-plane-o btn-icon-l p-r-2"></i>' . __('Send', 'wsph_ebf') . '</button> </div> </div></div> </section>';
        }
        return $this->form;
    }
}

//$pyt = "INSERT INTO table SET ( pole_txt = '". serialize( $tablica ) . "' " ;