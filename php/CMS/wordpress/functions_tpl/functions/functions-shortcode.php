<?php
//	Файл с шорткодами functions.php
//	Версия 1.0.0 от 31.10.2018
	
//	Шорткод кнопки
//	============================================================
	function shortcode_form_pay() {
		return '
		<div class="form form-pay">
			<div class="form-header">
				<div class="form-head">
					Оплатить online
				</div>
				<div class="form-desc">
					Уникальный номер заказа всегда можно уточнить у любого из менеджеров.
				</div>
			</div>
			
			<div class="form-body">
				<form method="POST" action='.admin_url("admin-post.php").'>
					<input type="hidden" name="action" value="pay_order">
					
					<div class="form-group">
						<label>Номер заказа</label>
						<input type="num" name="order-number" class="form-control "/>
					</div>
					
					<div class="form-group">
						<label>Стоимость заказа</label>
						<input type="num" name="order-price" class="form-control "/>
					</div>
					
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control "/>
					</div>
					
					<div class="button">
						<button type="submit" name="send" class="btn b-icon b-send">Перейти к оплате</button>
					</div>
				</form>
			</div>
			
		</div>
		';
	}
	add_shortcode('form_pay', 'shortcode_form_pay');


//	Шорткод формы для партнёров
//	============================================================
	function shortcode_form_partners() {
		return '<div class="form" style="padding:1.1rem 1.1rem">
                        <div class="form-header">
                            <div class="form-head">
                                Стать партнёром
                            </div>
                            <div class="form-desk" style="margin:0">
                                оставляй заявку и наш менеджер<br />
                                всё подробно расскажет
                            </div>
                        </div>
						<style>
						br {display:none}
						</style>
                        <div class="form-body">
                            <form method="POST" action="/thank">
                                <input type="hidden" name="formid" value="Партнеры" />
                                <input type="hidden" name="title" value="Стань партнёром | ФинЭкспертъ" />
                                <input type="hidden" name="utm_source" value="'. wp8p_UTM_set() .'" />

                                <div class="d-none"><input type="text" name="e-mail" /></div>

                                <div class="form-group formTel" style="margin-top:25px;">
                                    <input type="tel" name="phone" class="form-control required inp" />
                                    <label for="">Телефон*</label>
                                </div>

                                <div class="form-group formName">
                                    <input type="text" name="name1" class="form-control" />
                                    <label>Ваше имя</label>
                                </div>

                                <div class="button ct">
                                    <button type="submit" name="send" class="btn" disabled="">Хочу в партнёры</button>
                                </div>

                                <div class="checkbox lt">
                                    <input
                                        class="form-control agreement error"
                                        type="checkbox"
                                        checked="checked"
                                        value="Согласие на обработку данных"
                                        name="Agreement"
                                        id="agreement"
                                    />
                                    <label class="agreement-label" for="agreement" style="margin-left:40px"> Я даю свое согласие на обработку персональных данных и соглашаюсь с <a href="/privacy-policy/">политикой конфиденциальности</a> </label>
                                </div>
                                <input type="hidden" name="captcha" value="66ac17747b947b61a066369384896c79" />
                            </form>
                        </div>
                    </div>
		';
	}
	add_shortcode('form_partners', 'shortcode_form_partners');
	
//============================
add_shortcode('form_consultation', 'shortcode_form_consultation');
function shortcode_form_consultation($arg, $content) {

//echo "<pre>";	
//print_r($arg);
//echo "</pre>";
//echo htmlspecialchars($content);
	if( is_admin() ){
		return false;
	}		

	$errorMsg = "<p>Ошибка вставки, необходим параметер <b>{{field-name}}</b> = 'текст или HTML-код'</p>";
	$errorMsg .= "<div><small>пример кода вставки:<br>[form_consultation
form_title = '---заголовок формы---' 
form_desc = '<b>текст</b> перед полями' 
form_name = 'заголовок поля имя' 
form_email = 'заголовок поля email' 
form_btn = 'текст кнопки']<br><i>параметры перечисляются в одну строку, без переносов...</i></small></div>";
	
	$fieldName = "form_title";
	if( empty( $arg[ $fieldName ]) ){
		$errorMsg = str_replace("{{field-name}}", $fieldName, $errorMsg);
		return $errorMsg;
	}
	
	$fieldName = "form_desc";
	if( empty( $arg[ $fieldName ]) ){
		$errorMsg = str_replace("{{field-name}}", $fieldName, $errorMsg);
		return $errorMsg;
	}
	
	$fieldName = "form_name";
	if( empty( $arg[ $fieldName]) ){
		$errorMsg = str_replace("{{field-name}}", $fieldName, $errorMsg);
		return $errorMsg;
	}
	
	$fieldName = "form_email";
	if( empty( $arg[ $fieldName]) ){
		$errorMsg = str_replace("{{field-name}}", $fieldName, $errorMsg);
		return $errorMsg;
	}
	
	$fieldName = "form_btn";
	if( empty( $arg[ $fieldName]) ){
		$errorMsg = str_replace("{{field-name}}", $fieldName, $errorMsg);
		return $errorMsg;
	}
	
	$formTitle = $arg["form_title"];
	$formDesk = $arg["form_desc"];
	$formName = $arg["form_name"];
	$formEmail = $arg["form_email"];
	$formBtn = $arg["form_btn"];
//echo __FILE__;
//echo __DIR__;
//echo locate_template('blocks/block-form.php');
	
	//$html = "<h1>Test!!!</h1>";
	$html = "";
	$html .= "<div class='formWrap singlePage'>";
	include (locate_template('blocks/block-form.php'));
	$html = "</div>";
	return $html;
}//end
