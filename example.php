<?php

					
					$form = new_form('get', SCRIPT_URL, 'collect_form', 'navbar-form center');

					append_form(get_input_text('twt_add_interest','Your text'),$form);

					append_form(get_input_select('period', array('yesterday' => 'selected','today'=>''),'font1 btn-lg btn-default'),$form);

					append_form(get_input_hidden('token','qsfgjkqsdfhgjksdfkjgh',$form);

					echo $form;
