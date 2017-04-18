<?php

class AutoRiaComCrawler extends Crawler {

	protected $_url = 'http://vse-sto.com.ua/sto/{id}-';
    //protected $_url = 'http://auto.ria.com/auto_daewoo_lanos_{id}.html';
    //protected $_sources_organizations_id = 58;

    public static function isValidHTML($html)
    {
        return
            $html != ''
            && !preg_match('/(Авто удалено)|(удален с сайта)|(После ДТП)|(Авто не растаможено)|(Авто уже продано)|(500 Internal Server Error)|(Не на ходу)|(<span class="price">договорная<\/span>)/s', $html)
            && !preg_match('/<strong>(.*)(Мото|Водный транспорт|Спецтехника|Автодом|Воздушный транспорт)(.*)<\/strong>/s', $html)
            &&            preg_match('/(head-cars)/s', $html)
            ;

    }

//объявление
    //получаем Дату объявления
    protected function _parseDate()
    {
        $obj = $this->_html->find('[date]', 0);
        $this->_advert['date'] = (is_null($obj)) ? null : $this->clearValue($obj->date);
    }

//продавец
    //получаем Область
    protected function _parseRegionsTitle()
    {
        $obj = $this->_html->find('span[id=final_page__breadcrumbs_state]', 0);
        $this->_advert['regions_title'] = (is_null($obj)) ? null : $this->clearValue($obj->innertext);
    }

    //получаем Город
    protected function _parseSettlement()
    {
        $obj = $this->_html->find('span[id=final_page__breadcrumbs_city]', 0);
        $this->_advert['settlement'] = (is_null($obj)) ? null : $this->clearValue($obj->innertext);
    }

    //получаем Имя
    protected function _parseName()
    {
        $obj = $this->_html->find('dt[class=user-name]', 0);
        $this->_advert['name'] = (is_null($obj)) ? null : $this->clearValue($obj->innertext);
    }

    protected function _parsePhone()
    {
        $obj = $this->_html->find('div[id=final_page__user_phone_block] strong[class=phone]', 0);
        $this->_advert['phone'] = (is_null($obj)) ? null : preg_replace('/[^\.\d]/' , '', $obj->innertext);
    }

    //получаем Количество объявлений
    protected function _parseAdverts()
    {
        $obj = $this->_html->find('strong[id=final_page__user_ads_count]', 0);
        $this->_advert['adverts'] = (is_null($obj)) ? null : $this->clearValue($obj->plaintext);
    }

//автомобиль
    //получаем Категория транспортного средства
    protected function _parseCarCategoriesTitle()
    {
        $this->_advert['car_categories_title'] = null;
        foreach ($this->_html->find('div[class="span3 left-bar-view] div[class=characteristic delimeter] p') as $obj) {
            if (preg_match('/Тип транспорта/', $obj->plaintext)) {
                $this->_advert['car_categories_title'] = $this->clearValue($obj->find('strong', 0)->plaintext);
            }
        }
    }

    //получаем Марку
    protected function _parseCarBrandsTitle()
    {
        $obj = $this->_html->find('span[id=final_page__breadcrubs_marka]', 0);
        $this->_advert['car_brands_title'] = (is_null($obj)) ? null : $this->clearValue($obj->plaintext);
    }

    //получаем Модель
    protected function _parseCarModelsTitle()
    {
        $obj = $this->_html->find('h1[class=head-cars]', 0);
        if (is_null($obj)) {
            $this->_advert['car_models_title'] = null;
        } else {
            $this->_advert['car_models_title'] = trim(str_replace($this->_advert['car_brands_title'], '', $obj->plaintext) );
            $this->_advert['car_models_title'] = array(trim(TextHelper::substr($this->_advert['car_models_title'], 0, TextHelper::strlen($this->_advert['car_models_title']) - 4)));
        }

        $obj = $this->_html->find('span[id=final_page__breadcrumbs_model]', 0);
        $this->_advert['car_models_title'][] = (is_null($obj)) ? null : $this->clearValue($obj->plaintext);
    }

    //получаем Год
    protected function _parseCarYear()
    {
        $obj = $this->_html->find('span[class=year]', 0);
        $this->_advert['car_year'] = (is_null($obj)) ? null : $this->clearValue($obj->plaintext);
    }

    //получаем Тип кузова
    protected function _parseCarBodiesTitle()
    {
        $obj = $this->_html->find('strong[id=final_page__characteristic_body_name]', 0);
        $this->_advert['car_bodies_title'] = (is_null($obj)) ? null : $this->clearValue($obj->plaintext);
    }

    //получаем Привод
    protected function _parseCarDrivesTitle()
    {
        $this->_advert['car_drives_title'] = null;
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Привод/', $obj->plaintext)) {
                $this->_advert['car_drives_title'] = $this->clearValue($obj->find('strong', 0)->plaintext);
            }
        }
    }

    //получаем КПП
    protected function _parseCarTransmissionsTitle()
    {
        $this->_advert['car_transmissions_title'] = null;
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Коробка передач/', $obj->plaintext)) {
                $this->_advert['car_transmissions_title'] = $this->clearValue($obj->find('strong', 0)->plaintext);
            }
        }
    }

    //получаем Объем двигателя
    protected function _parseCarEngineSize()
    {
        $this->_advert['car_engine_size'] = null;
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Объем двигателя/', $obj->plaintext)) {
                $this->_advert['car_engine_size'] = preg_replace('/[^\.\d]/' , '', $obj->plaintext)*1000;
                if ($this->_advert['car_engine_size']>15000) $this->_advert['car_engine_size']=intval($this->_advert['car_engine_size']/10);
            }
        }
    }

    //получаем Двигатель
    protected function _parseCarEngineTypesTitle()
    {
        $this->_advert['car_engine_types_title'] = null;
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Топливо/', $obj->plaintext)) {
                $this->_advert['car_engine_types_title'] = $this->clearValue($obj->find('strong', 0)->plaintext);
            }
        }
    }

    //получаем Количество дверей
    protected function _parseCarDoors()
    {
        $this->_advert['car_doors'] = null;
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Количество дверей/', $obj->plaintext)) {
                $this->_advert['car_doors'] = preg_replace('/[^\d]/' , '', $obj->plaintext);
            }
        }
    }

    //получаем Количество мест
    protected function _parseCarSeats()
    {
        $this->_advert['car_seats'] = null;
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Количество мест/', $obj->plaintext)) {
                $this->_advert['car_seats'] = preg_replace('/[^\d]/' , '', $obj->plaintext);
            }
        }
    }

    //получаем Цвет
    protected function _parseCarColorsTitle()
    {
        $this->_advert['car_colors_title'] = '';
        foreach ($this->_html->find('section[class=box-panel] dl[class=unordered-list] dd') as $obj) {
            if (preg_match('/Цвет/', $obj->plaintext)) {
                $this->_advert['car_colors_title'] = $this->clearValue($obj->find('strong', 0)->plaintext);
            }
        }
    }

    //получаем Пробег
    protected function _parseCarRace()
    {
        $this->_advert['car_race'] = null;

        $obj = $this->_html->find('div[class=characteristic delimeter]', 0);

        if (!is_null($obj)) {
            foreach ($obj->find('p[class=item-param]') as $obj) {
                if (preg_match('/без пробега/', $obj->plaintext)) {
                    $this->_advert['car_race'] = 0;
                } else if (preg_match('/Пробег/', $obj->plaintext)) {
                    $this->_advert['car_race'] = preg_replace('/[^\d]/' , '', $obj->find('strong', 0)->innertext) * 1000;
                }
            }
        }
    }

    //получаем Опции
    protected function _parseCarOptions()
    {
        $this->_advert['car_options'] = array();
        foreach ($this->_html->find('div[class=box-panel rocon] p[class=additional-data]') as $obj) {
            if (preg_match('/Комфорт|Мультимедиа|Прочее|Безопасность|Состояние/', $obj->plaintext)) {
                $car_options = $this->clearValue(explode(',', preg_replace('|<strong[^>]*?>.*?</strong>|si', '', $obj->innertext)));
                $this->_advert['car_options'] = array_merge($this->_advert['car_options'], $car_options);
            }
        }
    }

    //получаем Описание
    protected function _parseCarDescription()
    {
        $obj = $this->_html->find('div[class=box-panel rocon] p[id=description]', 0);
        $this->_advert['car_description'] = (is_null($obj)) ? null : $this->clearValue($obj->innertext);
    }

    //получаем Цена в UAH
    protected function _parseCarPriceUAH()
    {
        $obj = $this->_html->find('div[class=price-seller] span[class=price]', 0);
        $this->_advert['car_price_uah'] = (is_null($obj)) ? null : preg_replace('/[^\d]/' , '', $obj->plaintext);
    }

    //получаем Цена в USD
    protected function _parseCarPriceUSD()
    {
        $obj = $this->_html->find('div[class=price-at-rate] span[class=price]', 1);
        $this->_advert['car_price_usd'] = (is_null($obj)) ? null : preg_replace('/[^\d]/' , '', $obj->plaintext);
    }

    //получаем Цена в EUR
    protected function _parseCarPriceEUR()
    {
        $obj = $this->_html->find('div[class=price-at-rate] span[class=price]', 0);
        $this->_advert['car_price_eur'] = (is_null($obj)) ? null : preg_replace('/[^\d]/' , '', $obj->plaintext);
    }
	
	protected function _parseTitleCarService()
	{
		//$obj = $this->_html->find("<span class='fn org'>");
		$obj = $this->_html->find('span[class=fn org]');
        $this->_advert['title_car_service'] = (is_null($obj)) ? null : $this->clearValue($obj->plaintext);
	}
}