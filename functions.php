<?php	
	
	//---------------------------------FORMS------------------------------

	function new_form($method='get', $action='', $id='', $class=''){
	
		$new_form='';
		
		if($action==''){
			
			$action=CUR_URL_BASE;
		}

		if($action!=''){
			
			$action=' action="'.$action.'";';
		}
		
		if($method!=''){
			
			$method=' method="'.$method.'";';
		}		

		if($id!=''){
			
			$id=' id="'.$id.'";';
		}
		
		if($class!=''){
			$class=' class="'.$class.'";';
		}
		
		$new_form.='<form'.$action.$method.$id.$class.'>';
		$new_form.='</form>';
		
		return $new_form;
	}
	
	function new_search_form($method='get', $action='', $id='search-form', $class=''){
	
		$new_form='';
		
		if($action==''){
			
			$action=CUR_URL_BASE;
		}

		if($action!=''){
			
			$action=' action="'.$action.'";';
		}
		
		if($method!=''){
			
			$method=' method="'.$method.'";';
		}		

		if($id!=''){
			
			$id=' id="'.$id.'";';
		}
		
		if($class!=''){
			$class=' class="'.$class.'";';
		}
		
		$new_form.='<form'.$action.$method.$id.$class.' name="search-form" role="search" >';
		
			$new_form.= '<div class="input-group">';
				
				if(PAGE_SLUG !=''){
					
					$placeholder=PAGE_SLUG;
				}
				else{
					
					$placeholder=translate($framework, 'search').'...';
				}
				
				$new_form.= '<input type="text" class="form-control" placeholder="'.$placeholder.'" id="query" name="q" value="">';
				
				if(CUR_REQUEST_QSA != ''){
					
					parse_str(CUR_REQUEST_QSA,$request_qsa);
					
					if(!empty_array($request_qsa)){
						
						foreach($request_qsa as $name => $value){
							
							if($name!='q'){
								
								$new_form.=get_input_hidden($name,$value);
							}
						}
					}
				}
				
				
				$new_form.= '<div class="input-group-btn">';

					$new_form.= '<button type="submit" class="btn btn-success">';

						$new_form.= '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>';

					$new_form.= '</button>';

				$new_form.= '</div>';

			$new_form.= '</div>';

			
			
		$new_form.='</form>';
		
		return $new_form;
	}

	function append_form($cur_input='',&$cur_form='',$submit='Submit'){

		if($cur_form==''){
			
			$cur_form=new_form('get','','collect_form','navbar-form');
		}
		
		if($cur_input!=''){
			
			$submit_input='';
			
			if(!empty_string($submit)){
				
				$submit_input=get_input_submit($submit);
			}
		
			$cur_form=str_replace($submit_input,'',$cur_form);
			
			$cur_form=str_replace('</form>',$cur_input.$submit_input.'</form>',$cur_form);
		}
		
		return $cur_form;
	}

	function get_input_submit($value='submit', $class='btn btn-primary', $input_group=false){
		
		$submit_input='';
		
		if($value!=''){
			
			$value=' value="'.custom_ucfirst($value).'";';
		}	

		if($class!=''){
			
			$class=' class="'.$class.'";';
		}				
		
		if($input_group===true){
			
			$submit_input.='<div class="input-group-btn">';
		}
		else{
			
			$submit_input.='<div class="input-group">';
		}
			$submit_input.='<input type="submit"'.$value.$class.'>';
			
		$submit_input.='</div>';
		
		return $submit_input;
	}

	function get_input_select($name='', $options=array(), $class='btn btn-primary'){
	
		if($class!=''){
		
			$class=' class="'.$class.'"';
		}
		
		$select_input='';
		if($name!=''){
		
			$select_input.='<select name="'.$name.'"'.$class.'>';
			
				foreach($options as $option => $select){
					
					$selected ='';
					if($select=='selected'){
					
						$selected =' selected="selected"';
					}

					$select_input.='<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
				}
				
			$select_input.='</select>';
		}
		
		return $select_input;
	}	
	
	function get_input_text($name='',$label='',$value='',$is_disabled=false,$submit=''){
		
		$text_input='';
		
		if($name!=''){
			
			if($label==''){
				$label=$name;
			}					
		
			$disabled='';
			if($is_disabled===true){
				$disabled=' disabled';
			}
			//$submit
			$text_input.='<div class="input-group">';
			
				$text_input.='<label class="input-group-addon">'.$label.'</label>';
				$text_input.='<input class="form-control" name="'.$name.'" type="text" value="'.$value.'"'.$disabled.'/>';
				
				if(!empty_string($submit)){
					
					$text_input.='<span class="input-group-btn">';
					
						//$text_input.='<button class="btn btn-default" type="button">'.$submit.'</button>';
						
						$text_input.='<input class="btn btn-default" type="submit" value="'.$submit.'">';
					
					$text_input.='</span>';
				}				
				
			$text_input.='</div>';
	
		}
		return $text_input;
	}
	
	function get_input_text_onclick($name='',$label='',$value='',$display='none'){
		
		$text_input_onclick='';
		
		$id=separate_words($name,'_');

		if($label==''){
			$label=$name;
		}		
		
		$checked='';
		if($display!='none'){
			$checked=' checked';
		}
		
		$text_input_onclick.='<div style="text-align:right;">';
			
			$text_input_onclick.='<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
			$text_input_onclick.='<label>'.$label.'</label> ';
			$text_input_onclick.='<input type="checkbox" id="'.$id.'" class="toggle_input"'.$checked.'>';			
			
			$text_input_onclick.='<div class="input-group input-group-sm" id="'.$id.'_input" style="width:55%;display:'.$display.';">';
			
				$text_input_onclick.='<input class="form-control" name="'.$name.'" type="text" value="'.$value.'"/>';
			
			$text_input_onclick.='</div>';	
			
		$text_input_onclick.='</div>';//input-group
		
		return $text_input_onclick;
	}
	
	function get_input_checkbox($name='',$label='',$is_disabled=false){
		
		$checkbox_input='';
		if($name!=''){
			
			if($label==''){
				$label=$name;
			}		
			
			$disabled='';
			if($is_disabled===true){
				
				$disabled=' disabled';
			}
					
			$checkbox_input.='<div class="checkbox right">';
			
				$checkbox_input.='<label>';
				
					$checkbox_input.='<input type="checkbox" name="'.$name.'" value="true"'.$disabled.'>';
					$checkbox_input.=' '.$label.' ';
					
				$checkbox_input.='</label>';
				
			$checkbox_input.='</div>';
		}
		
		return $checkbox_input;
	}

	function get_input_hidden($name='',$value=''){
		
		$hidden_input='';
		
		if($name!=''){
			
			$hidden_input.='<input name="'.$name.'" type="hidden" value="'.$value.'" />';
		}
		
		return $hidden_input;
	}

	function get_input_multiple($multi_input_data=array()){
		
		$multiple_input='';
		
		if(!empty_array($multi_input_data)){
		
			foreach($multi_input_data as $input_name => $input_data){
			
				$input_label=$input_data['label'];
				$input_value='';
				
				if(isset($input_data['value'])){
					
					$input_value=$input_data['value'];
				}
				
				$multiple_input.=get_input_text($input_name,$input_label,$input_value);
			}
		}
		return $multiple_input;
	}
	
	function get_bl_label($content=''){
		
		$bl_label='';
			
		$bl_label.='<label>';
		
			$bl_label.=$content;
			
		$bl_label.='</label>';
			
		return $bl_label;
	}

	function new_text_input($name='',$label='Tell me something...',$value='',$method='get',$action='',$submit=''){
		
		$new_form='';
		
		if($name!=''){
			
			$new_form=new_form($method,$action,'collect_form','navbar-form');
			
			$text_input=get_input_text($name,$label,$value,false,$submit);
			
			append_form($text_input,$new_form);
			
			if($submit==''){
			
				append_form(get_input_submit('submit'),$new_form,$submit);
			}
		}
		return $new_form;
	}

	function new_multi_input($input_data=array(),$method='get'){
		
		$new_form='';
		
		if(!empty_array($input_data)){
			
			$new_form=new_form($method,'','collect_form','navbar-form');
			
			$multiple_input=get_input_multiple($input_data);
			
			append_form($multiple_input,$new_form);
			
			append_form(get_input_submit('submit'),$new_form);
		}
		
		return $new_form;
	}
