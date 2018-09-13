<?php
	/*
	Template Name: Мой шаблон регистрации
	Template Post Type: post, page, product
	*/
?>


<div class="tab-content form-holder">
	<div class="tab-pane active" id="full-form" role="tabpanel" aria-labelledby="form-tab" aria-expanded="true">
		<div class="clearfix">
			<form id="become-a-rep" class="secure-submit" action="<?php echo get_template_directory_uri()?>/plugins/_post.php" method="get">

				<?php wp_nonce_field('name_of_my_action','name_of_nonce_field'); ?>
				<input type="hidden" name="subject" value="Расширенная форма регистрации">
				<div class="input-group input-group-sm sizer"><span class="input-group-addon"><span>Фамилия Имя Отчество</span><i class="fa fa-user hidden-xs-up pink"></i></span>
					<input name="names" type="text" class="form-control" placeholder="Иванова Елена Викторовна" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Дата рождения</span>
					<input name="dob" type="text" class="form-control" placeholder="10/10/1980" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Серия и номер паспорта</span>
					<input name="passport" type="text" class="form-control" placeholder="AB654321" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Дата выдачи паспорта</span>
					<input name="passdate" type="text" class="form-control" placeholder="10/10/2010" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Идентификационный код</span>
					<input name="incode" type="text" class="form-control" placeholder="987654321054321" required="">
				</div>
				<div class="input-group input-group-sm">
                      <span class="input-group-addon">
                      <span>Адрес прописки</span><span>Обл.</span>
                      </span>
					<select name="state" class="form-control custom-select" required="">
						<option disabled="" label="Выбрать из списка"></option>
						<option value="1">Винницкая</option>
						<option value="2">Волынская</option>
						<option value="3">Днепропетровская</option>
						<option value="4">Донецкая</option>
						<option value="5">Житомирская</option>
						<option value="6">Закарпатская</option>
						<option value="7">Запорожская</option>
						<option value="8">Ивано-Франковская</option>
						<option value="9">Киевская</option>
						<option value="10">Кировоградская</option>
						<option value="11">Луганская</option>
						<option value="12">Львовская</option>
						<option value="13">Николаевская</option>
						<option value="14">Одесская</option>
						<option value="15">Полтавская</option>
						<option value="16">Ровенская</option>
						<option value="17">Сумская</option>
						<option value="18">Тернопольская</option>
						<option value="19">Харьковская</option>
						<option value="20">Херсонская</option>
						<option value="21">Хмельницкая</option>
						<option value="22">Черкасская</option>
						<option value="23">Черновицкая</option>
						<option value="24">Черниговская</option>
					</select>
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Населенный пункт</span>
					<input name="city" type="text" class="form-control" placeholder="Киев" required="">
				</div>
				<div class="input-group input-group-sm sizer"><span class="input-group-addon"><span>Улица, дом, квартира</span><i class="fa fa-map-pin hidden-xs-up pink"></i></span>
					<input name="address" type="text" class="form-control" placeholder="Десятинная, 10, 10" required="">
				</div>
				<div class="input-group input-group-sm">
                      <span class="input-group-addon">
                      <span>Адрес доставки</span><span>Обл.</span>
                      </span>
					<select name="state1" class="form-control custom-select" required="">
						<option disabled="" label="Выбрать из списка"></option>
						<option value="1">Винницкая</option>
						<option value="2">Волынская</option>
						<option value="3">Днепропетровская</option>
						<option value="4">Донецкая</option>
						<option value="5">Житомирская</option>
						<option value="6">Закарпатская</option>
						<option value="7">Запорожская</option>
						<option value="8">Ивано-Франковская</option>
						<option value="9">Киевская</option>
						<option value="10">Кировоградская</option>
						<option value="11">Луганская</option>
						<option value="12">Львовская</option>
						<option value="13">Николаевская</option>
						<option value="14">Одесская</option>
						<option value="15">Полтавская</option>
						<option value="16">Ровенская</option>
						<option value="17">Сумская</option>
						<option value="18">Тернопольская</option>
						<option value="19">Харьковская</option>
						<option value="20">Херсонская</option>
						<option value="21">Хмельницкая</option>
						<option value="22">Черкасская</option>
						<option value="23">Черновицкая</option>
						<option value="24">Черниговская</option>
					</select>
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Населенный пункт</span>
					<input name="city1" type="text" class="form-control" placeholder="Киев" required="">
				</div>
				<div class="input-group input-group-sm sizer"><span class="input-group-addon"><span>Улица, дом, квартира</span><i class="fa fa-map-pin hidden-xs-up pink"></i></span>
					<input name="address1" type="text" class="form-control" placeholder="Десятинная, 10, 10" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Почтовый индекс <i class="fa fa-question-circle-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Если вы знаете, укажите индекс отделения Укрпочты, где бы вы предпочли получать посылки AVON."></i></span>
					<input name="postalcode" type="text" class="form-control notreq" placeholder="10000">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Номер мобильного</span>
					<input name="phone" type="tel" class="form-control" placeholder="0987654321" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Электронная почта</span>
					<input name="email" type="email" class="form-control" placeholder="mail@example.com" required="">
				</div>
				<div class="form-group text-xs-center">
					<label class="custom-control custom-checkbox">
						<input name="credit" id="credit" type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description">Оплачивать заказ после получения</span></label>
				</div>
				<!--<div class="form-group text-xs-center">
				  <label class="custom-control custom-checkbox">
					<input name="terms" type="checkbox" autocomplete="off" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description">Согласие на обработку персональных данных</span></label>
				  </div>-->
				<div class="form-group mb-1">
					<input type="submit" class="btn btn-block btn-outline-secondary pink" value="Отправить анкету">
				</div>
				<input type="hidden" name="IREFERRER" value="direct"><input type="hidden" name="LREFERRER" value="direct"><input type="hidden" name="ILANDPAGE" value="https%3A//avon.org.ua/"><input type="hidden" name="VISITS" value="7"></form>
		</div>
	</div>
	<div class="tab-pane" id="quickform" role="tabpanel" aria-labelledby="quick-form-tab" aria-expanded="false">
		<div>
			<form id="quick-form" class="secure-submit" action="/plugins/_post.php" method="post">
				<?php wp_nonce_field('name_of_my_action','name_of_nonce_field'); ?>
				<input type="hidden" name="subject" value="Упрощенная форма регистрации">
				<div class="input-group input-group-sm"><span class="input-group-addon">Фамилия Имя</span>
					<input name="names" type="text" class="form-control" placeholder="Иванова Елена" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Номер мобильного</span>
					<input name="phone" type="tel" class="form-control" placeholder="0987654321" required="">
				</div>
				<div class="input-group input-group-sm"><span class="input-group-addon">Электронная почта</span>
					<input name="email" type="email" class="form-control" placeholder="mail@example.com" required="">
				</div>
				<!--<div class="form-group text-xs-center">
				  <label class="custom-control custom-checkbox">
					<input name="terms" type="checkbox" autocomplete="off" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description">Согласие на обработку персональных данных</span></label>
				  </div>-->
				<div class="form-group mb-1">
					<input type="submit" class="btn btn-md btn-block btn-outline-secondary pink" value="Отправить анкету">
				</div>
				<div class="card text-xs-center mb-1">
					<div class="card-block mb-1">
						<p>Присоединяйся - открой для себя AVON!</p>
						<p>AVON больше, чем красота.</p>
					</div>
					<img src="<?php echo get_template_directory_uri();?>/image/avon_girls_2.png" class="img-fluid" alt="AVON - компания для женщин">
				</div>
				<input type="hidden" name="IREFERRER" value="direct"><input type="hidden" name="LREFERRER" value="direct"><input type="hidden" name="ILANDPAGE" value="https%3A//avon.org.ua/"><input type="hidden" name="VISITS" value="7"></form>
		</div>
	</div>
	<div class="m-stat">
		<div>
			<div class="status sending">
				<p class="alert alert-info text-xs-center">Отправка анкеты...</p>
			</div>
			<div class="status success">
				<p class="alert alert-success text-xs-center">Ваша анкета отправлена успешно и будет обработана в ближайшее время.</p>
				<p class="alert alert-info text-xs-center"><strong>Добавьте в друзья</strong> партнера <a href="https://vk.com/avon.berd" title="AVON ВКонтакте" target="_blank">AVON ВКонтакте</a>, <a href="https://www.facebook.com/avon.berd" title="AVON Facebook" target="_blank">Facebook'е</a> или <a href="https://ok.ru/profile/243879796722" title="AVON Одноклассники" target="_blank">в Одноклассниках</a>, <strong>Вы получите сообщение с Вашим персональным счетом AVON</strong>.</p>
				<div class="card pink-border text-xs-center s-info">
					<div class="card-header">Оплата заказа после получения</div>
					<div class="card-block clearfix">
						<div>Вы выбрали опцию оплаты заказа после получения. Для завершения активации данной опции, пожалуйста, отправьте электронную копию (например: фото, сканированное изображение) Вашего паспорта на адрес эл. почты <span class="email email-verify"></span>, либо <a href="#choose-chanel" class="c-more">партнеру AVON в социальной сети</a>.</div>
					</div>
				</div>
				<div class="card link-card text-xs-center mb-1 s-rel">
					<div class="card-header">Полезные ссылки</div>
					<div class="card-block clearfix"><a class="btn pink btn-secondary btn-block mb-1" title="AVON - отправка заказа, получение и оплата" href="/place-an-order">Отправка, получение и оплата заказа</a><a class="btn pink btn-secondary btn-block mb-1" title="Программа развития представителей" href="/promotion">Программа развития представителей</a><a class="btn pink btn-secondary btn-block mb-1" title="Группа AVON - Вконтакте" href="https://vk.com/avonorgua" target="_blank">Группа AVON - Вконтакте</a><a class="btn pink btn-secondary btn-block mb-1" title="Текущий каталог" href="/current-catalog">Текущий каталог</a><a class="btn pink btn-secondary btn-block" title="Текущая распродажа" href="/current-sale">Текущая распродажа</a></div>
				</div>
			</div>
			<div class="status incomplete">
				<p class="alert alert-danger text-xs-center">Не все поля формы заполнены.</p>
			</div>
			<div class="status failure">
				<p class="alert alert-danger text-xs-center">При отправке формы произошла ошибка. Пожалуйста, свяжитесь с админстраторм сайта admin<span class="fa-hide-mail"></span>avon.org.ua.</p>
			</div>
		</div>
	</div>
</div>