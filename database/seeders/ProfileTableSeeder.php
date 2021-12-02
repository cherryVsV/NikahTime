<?php

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\Interest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$users = [
            [
                'phone' => '89178730547', 'email'=>'Veter717@list.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Артур', 'last_name' => 'Ахметгалиев',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1_cbiwayJ8Tle2ejbxYA4m_5FHfJnvN-O'], 'gender' => 'male',
                'birth_date' => '15.11.1986', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89178730547',
                'education_id' => 5, 'place_of_study' => 'Казанский медицинский университет', 'work_position' => 'Врач и преподаватель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение']
            ],
            [
                'phone' => '89172563508', 'email'=>'rezeda533@inbox.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Резеда', 'last_name' => 'Сабитова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1giULvsaQ8ADTy94TuGFSD1gXLek6G69V', 'https://drive.google.com/u/0/open?usp=forms_web&id=1Tn70i7jHu51v4rKOCu4cjvtiFT-V3mRV', 'https://drive.google.com/u/0/open?usp=forms_web&id=15fgIb-Q9wABtH-wJuurwI8iU6SZYxztR'], 'gender' => 'female',
                'birth_date' => '15.11.1974', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89172563508',
                'education_id' => 5, 'place_of_study' => 'КФУ', 'work_position' => 'Эколог',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Прогулки по лесу', 'Путешествия', 'Кулинария']
            ],
            [
                'phone' => '89046694356', 'email'=>'Elya.ru52@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Эльвира', 'last_name' => 'Зиннатуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1T8seQyWjXWTLXX_eDsdkU6ivG21ACTHb'], 'gender' => 'female',
                'birth_date' => '27.05.1995', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89046694356',
                'education_id' => 5, 'place_of_study' => 'Казанский Федеральный Университет', 'work_position' => 'Преподаватель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Изучение истории']
            ],
            [
                'phone' => '79178581906', 'email'=>'alfiya-100@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альфия', 'last_name' => 'Усманова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=14dKyOkU4AWwR3UZm-NKkztcXGg5xfytq', 'https://drive.google.com/u/0/open?usp=forms_web&id=1E6nAfieJ1bo_qNqdGTMGr0ruI8AJsJz1', 'https://drive.google.com/u/0/open?usp=forms_web&id=18EHuwVtajoNYTepcH5fcts8H1fhCRT8-'], 'gender' => 'female',
                'birth_date' => '05.12.1988', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79178581906',
                'education_id' => 5, 'place_of_study' => 'Татарский государственный гуманитарно-педагогический университет', 'work_position' => 'Менеджер в компании',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Танцы', 'Мода', 'Стиль']
            ],
            [
                'phone' => '79172697512', 'email'=>'mavlievb@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Булат', 'last_name' => 'Мавлиев',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=12QHi8u5IxLUk1GriWVjLhDBfrpIXVmMy'], 'gender' => 'male',
                'birth_date' => '15.11.1978', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79172697512',
                'education_id' => 5, 'place_of_study' => 'Юридический институт МВД РФ', 'work_position' => 'Своё дело в сфере индустрии Wellness',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Занятия на свежем воздухе', 'Познание мироздания']
            ],
            [
                'phone' => '89047678695', 'email'=>'fatkhoullina.f.f@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Фалия', 'last_name' => 'Фатхуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1jucyjhzInWvqZ6GjSygxzRVo1Vf0qM3D'], 'gender' => 'female',
                'birth_date' => '15.11.1995', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89047678695',
                'education_id' => 5, 'place_of_study' => 'КГМУ', 'work_position' => 'Медицина. Врач-терапевт',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Вязание']
            ],
            [
                'phone' => '89509694618', 'email'=>'aygul.tazetdinova.2017@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айгуль', 'last_name' => 'Тазетдинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1h_zRQGEMGmpj-JsjxFtUkCth9LLh4SAZ'], 'gender' => 'female',
                'birth_date' => '29.01.1985', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89509694618',
                'education_id' => 4, 'place_of_study' => 'КФУ', 'work_position' => 'Бухгалтер',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Кулинария']
            ],
            [
                'phone' => '79393902388', 'email'=>'shaydullinayrat@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айрат', 'last_name' => 'Шайдуллин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1DQtGaDCLSCFjdXY_AhQi0KcQnlkbU0vU', 'https://drive.google.com/u/0/open?usp=forms_web&id=174LeWkXGFZz9ZyKE2yTNfQBhNuNAetoT'], 'gender' => 'male',
                'birth_date' => '15.11.1987', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79393902388',
                'education_id' => 5, 'place_of_study' => 'КФУ', 'work_position' => 'Индивидуальный предприниматель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Мое дело - мое хобби']
            ],
            [
                'phone' => '89196391276', 'email'=>'gulkam74@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульнара', 'last_name' => 'Камалеева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1BSF2y7P1T39WpSVRv9eTxbujr_AfghSw', 'https://drive.google.com/u/0/open?usp=forms_web&id=1d_9pzQD5Ei6XxHgrWwt7ar7TVBRoWcuD', 'https://drive.google.com/u/0/open?usp=forms_web&id=1hvDSDYtGdEKEe9KKZIH3UArw5dfmuHdE', 'https://drive.google.com/u/0/open?usp=forms_web&id=1jGfW2wgP6Uef7dkD9hNWu6CCTaGqqtyj'], 'gender' => 'female',
                'birth_date' => '07.03.1974', 'country' => 'Россия', 'city' => 'Набережные Челны', 'contact_phone_number' => '89196391276',
                'education_id' => 4, 'place_of_study' => 'Институт', 'work_position' => '',
                'place_of_work' => 'Эстетика лица и тела', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Спорт'], 'habits'=>['alcohol']
            ],
            [
                'phone' => '79173920585', 'email'=>'Gylia2704@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульчира', 'last_name' => 'Гилязова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1xUKzQNHcFcJemJpkZKhTLU8FVoAOMhDa'], 'gender' => 'female',
                'birth_date' => '15.11.1960', 'country' => 'Россия', 'city' => 'Татарстан, г. Нижнекамск.', 'contact_phone_number' => '79173920585',
                'education_id' => 3, 'place_of_study' => 'Мед. училище', 'work_position' => 'На пенсии, альхамдулиЛляях',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Изучение своей религии', 'Медицина']
            ],

            [
                'phone' => '89867232324', 'email'=>'Raushaniya24.5@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Р. Г.', 'last_name' => 'Гибадуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1G8L5Ot6WYk5jkgcO7CRrpN9PH4ir2X4S'], 'gender' => 'female',
                'birth_date' => '24.05.1991', 'country' => 'Россия', 'city' => 'Елабуга', 'contact_phone_number' => '89867232324',
                'education_id' => 5, 'place_of_study' => 'КГМУ', 'work_position' => 'Заведующая аптекой',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Татарский вокал', 'Восточные танцы', 'Чтение', 'Природа']
            ],

            [
                'phone' => '89178947326', 'email'=>'rezeda_new92mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Резеда', 'last_name' => 'Нуруллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1J-6uIQrYWFKrGv1PM45GdhL6VRpukUy6'], 'gender' => 'female',
                'birth_date' => '05.12.1992', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89178947326',
                'education_id' => 5, 'place_of_study' => 'РМАТ (Российская Международная Академия Туризма)', 'work_position' => 'Менеджер по работе с партнерами',
                'place_of_work' => 'В мебельном бизнесе', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Путешествия']
            ],
            [
                'phone' => '89105306777', 'email'=>'kameliya.mansurova@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Камиля', 'last_name' => 'Мансурова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1drnQkZQjVrtBLKw1duIljFVUQb9nd_r7', 'https://drive.google.com/u/0/open?usp=forms_web&id=1DV4uoAiY3IOhBixyM0_NZEpT40dbv4jR', 'https://drive.google.com/u/0/open?usp=forms_web&id=1fzlXk3fOCO355TBpKgLpd2lrJHZjM7E2', 'https://drive.google.com/u/0/open?usp=forms_web&id=10zlcoIpbbtIi7Bl7KXirUrQZc1rfzGl-', 'https://drive.google.com/u/0/open?usp=forms_web&id=1tan2Cv8jCMHJrIpZgjTI4vYKnoucCRZO'], 'gender' => 'female',
                'birth_date' => '16.11.1995', 'country' => 'Россия', 'city' => 'Тверь', 'contact_phone_number' => '89105306777',
                'education_id' => 5, 'place_of_study' => 'Тверской государственный университет', 'work_position' => 'Менеджер по работе с партнерами',
                'place_of_work' => 'В мебельном бизнесе', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Путешествия']
            ],
            [
                'phone' => '79372887592', 'email'=>'al.kadyrov@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альберт', 'last_name' => 'Кадыров',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1sx0ZIbKXfsafBOOnnhBhv29g4JQWXomb'], 'gender' => 'male',
                'birth_date' => '12.07.1979', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79372887592',
                'education_id' => 5, 'place_of_study' => '', 'work_position' => 'Преподаватель, переводчик',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Бег']
            ],

            [
                'phone' => '89274182005', 'email'=>'Gulya24_1994@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульфина', 'last_name' => 'Зайнутдинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1NOIXtbnhezP3ZZzJjoo3HCNA4Xjz70ud'], 'gender' => 'female',
                'birth_date' => '24.01.1994', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274182005',
                'education_id' => 3, 'place_of_study' => 'Казанский медицинский колледж', 'work_position' => 'Работаю на должности зав. аптеки',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Волейбол']
            ],

            [
                'phone' => '89274101412', 'email'=>'Rashidbua@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рашид', 'last_name' => 'Амишов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=11cg9TU-qThqfvuQiT0T0yoqhCuPTdVKm', 'https://drive.google.com/u/0/open?usp=forms_web&id=1NPo-jfpZnKhcOv5dpIDWa0QV8B7XTW1j'], 'gender' => 'male',
                'birth_date' => '15.11.1987', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274101412',
                'education_id' => 6, 'place_of_study' => 'Педагогический университет (ТГГПУ), Институт истории им. Ш. Марджани Академии наук Республики Татарстан (аспирантура, стал кандатом исторических наук), Российский исламский университет, сечас учусь в доктарантуре КФУ пишу докторскую диссертацию', 'work_position' => 'Образовательная, научная сфера. Доцент, преподаватель в университете',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Общение', 'Посещение тренингов', 'Саморазвитие', 'Путешествия', 'Прогулки', 'Природа', 'Писать книги', 'Снимать документальные фильмы по истории', 'Начал блог в инстаграмме ввести @history_tatar']
            ],

            [
                'phone' => '79370091811', 'email'=>'fandas-2010@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Фандас', 'last_name' => 'Ахметзянов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1MjCedB7SiSbHuh9aOUyt_KgDYfEiYea0'], 'gender' => 'male',
                'birth_date' => '10.07.1992', 'country' => 'Россия', 'city' => 'Апастовский район', 'contact_phone_number' => '79370091811',
                'education_id' => 5, 'place_of_study' => 'Казанский государственный архитектурно-строительный университет', 'work_position' => '',
                'place_of_work' => 'В газовой службе', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Хоккей', 'Обустройство быта']
            ],

            [
                'phone' => '89274702873', 'email'=>'irek-ahmadullin@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ирек', 'last_name' => 'Ахмадуллин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=18jubGwix7u-BICo3Ezj4c8GXT4ArUZl2', 'https://drive.google.com/u/0/open?usp=forms_web&id=1-nnY6-EfQGi41w98SXLdRPAv7vnDL5ie', 'https://drive.google.com/u/0/open?usp=forms_web&id=13NwUqUt7DtALElaiGc9Rk_jTyTd1-fFL'], 'gender' => 'male',
                'birth_date' => '15.11.1988', 'country' => 'Россия', 'city' => 'Набережные Челны', 'contact_phone_number' => '89274702873',
                'education_id' => 5, 'place_of_study' => 'Казанский инновационный университет', 'work_position' => 'Продажи, менеджер',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Спорт', 'Бег', 'Плаванье']
            ],

            [
                'phone' => '89274196280', 'email'=>'dilyabdr@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Диляра', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1LRdL6mY4YZjYWUJKNluSe0mzYNFhyMiO'], 'gender' => 'female',
                'birth_date' => '15.11.1996', 'country' => 'Россия', 'city' => 'Разные города', 'contact_phone_number' => '89274196280',
                'education_id' => 5, 'place_of_study' => 'Кгасу', 'work_position' => 'Архитектор',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Путешествия']
            ],

            [
                'phone' => '79172255481', 'email'=>'albina0583@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альбина', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=11R9DowsI0caTTnCJPDnz51tc3xujxL7n', 'https://drive.google.com/u/0/open?usp=forms_web&id=1W7o6vsY5zdUazbkPctl_kLICCEqL94k3', 'https://drive.google.com/u/0/open?usp=forms_web&id=1uCI_WhDRcZJSEjvC9VpD9QL2K1iWXvPq'], 'gender' => 'female',
                'birth_date' => '14.05.1983', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79172255481',
                'education_id' => 5, 'place_of_study' => 'Казанский федеральный университет', 'work_position' => 'Юрист',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Театр', 'Прогулки на природе']
            ],

            [
                'phone' => '89277106123', 'email'=>'gelka63@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гелия', 'last_name' => 'Юнусовна',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1G6KmUCh6SWPNX-sRua9sMEwQlQMUWZtB'], 'gender' => 'female',
                'birth_date' => '24.04.1983', 'country' => 'Россия', 'city' => 'Самара', 'contact_phone_number' => '89277106123',
                'education_id' => 5, 'place_of_study' => 'Самарский государственный медицинский университет', 'work_position' => 'Медицина, врач',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Театр', 'Путешествия']
            ],

            [
                'phone' => '89047178243', 'email'=>'mrboltis@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Булат', 'last_name' => 'Мубаракшин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1b9qBiIW-Wdv1DMlhIJWjOSVj8-SpF1B7'], 'gender' => 'male',
                'birth_date' => '15.11.1991', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89047178243',
                'education_id' => 5, 'place_of_study' => 'КНИТУ(КХТИ)', 'work_position' => 'IT, инженер поддержки приложений',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Бег', 'Лыжи', 'Футбол', 'Тренирую детей по футболу']
            ],

            [
                'phone' => '89600405344', 'email'=>'Alfiyazayka@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альфия', 'last_name' => 'Ахунова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1505PS7tJkn9cUWgt_DFPJ4NlkF88h9aH'], 'gender' => 'female',
                'birth_date' => '16.08.1983', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89600405344',
                'education_id' => 5, 'place_of_study' => 'Казанский государственный финансово-экономический институт', 'work_position' => 'Бухгалтер в энергокомпании',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => true, 'interests' => ['Прогулки', 'Поездки']
            ],

            [
                'phone' => '89196971077', 'email'=>'raushan262@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Раушан', 'last_name' => 'Габдрахманов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=19RxJZIY4k9Yh54vD2TPsGtxUDzN8f7Zb'], 'gender' => 'male',
                'birth_date' => '26.08.1990', 'country' => 'Россия', 'city' => 'Арск', 'contact_phone_number' => '89196971077',
                'education_id' => 5, 'place_of_study' => 'Энергетический университет', 'work_position' => 'Энергетическая сфера, энергетик',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Автомобили', 'Электрика']
            ],

            [
                'phone' => '89172805980', 'email'=>'milachkalina@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алина', 'last_name' => 'Гайнутдинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1M9Imj1ZSVAIcuALIy8_UpWrVqLfS5Mai', 'https://drive.google.com/u/0/open?usp=forms_web&id=1BYf6X3j4mPUuSbRG4XcMGN6fI_eafIZR'], 'gender' => 'female',
                'birth_date' => '09.10.1986', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89172805980',
                'education_id' => 5, 'place_of_study' => 'ТГГПУ', 'work_position' => '',
                'place_of_work' => 'Образование', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Садоводство']
            ],

            [
                'phone' => '89046670264', 'email'=>'Gisha885@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гилала', 'last_name' => 'Шафиева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=11c_a3qhVCx9nUAhSXXYWmKfDVI_jobzk'], 'gender' => 'female',
                'birth_date' => '26.12.1989', 'country' => 'Россия', 'city' => 'Иннополис', 'contact_phone_number' => '89046670264',
                'education_id' => 5, 'place_of_study' => 'ТГГПУ', 'work_position' => 'Образование, преподаватель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Рисование', 'Чтение', 'Путешествия']
            ],

            [
                'phone' => '89397443004', 'email'=>'Kasimjan19951213@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Низамат', 'last_name' => 'Касым',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1X6LDmWJ7v73WPC90zLmIqRGzCJNeMxYQ'], 'gender' => 'male',
                'birth_date' => '15.11.1996', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89397443004',
                'education_id' => 5, 'place_of_study' => 'КАИ', 'work_position' => 'Переводчик, экономист',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Футбол', 'Плавание', 'Бильярд']
            ],

            [
                'phone' => '79030622171', 'email'=>'zin.a83@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алия', 'last_name' => 'Зиннатуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1vVUa3Bwy1UmWwHAp_BA3aZUoO2jQdPIC', 'https://drive.google.com/u/0/open?usp=forms_web&id=1tI4-GOrkUdpiy6RmMbRZuL9f24l30Psv', 'https://drive.google.com/u/0/open?usp=forms_web&id=12v_zrQ7M-GXlKTjB8cnpm2I4ZKs8uD-Z'], 'gender' => 'female',
                'birth_date' => '15.11.1983', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79030622171',
                'education_id' => 5, 'place_of_study' => 'ИГМА', 'work_position' => 'Переводчик, экономист',
                'place_of_work' => 'Медицина', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Вязание', 'Чтение', 'Театр']
            ],

            [
                'phone' => '89172503050', 'email'=>'Alsumts@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алсу', 'last_name' => 'Саттарова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Gg4hMlGeOouGmd1NWUh_hYV_PY5Z5FeF', 'https://drive.google.com/u/0/open?usp=forms_web&id=1rPj5tXszoEbLlR0UKABX8i1bkiBivDTy'], 'gender' => 'female',
                'birth_date' => '26.09.1985', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89172503050',
                'education_id' => 5, 'place_of_study' => 'КГПУ', 'work_position' => '',
                'place_of_work' => 'Hr', 'marital_status_id' => 3, 'have_children' => true
            ],

            [
                'phone' => '89279494398', 'email'=>'Arslanovalbert1@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альберт', 'last_name' => 'Арсланов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1-Zbdo_w-12jm8SIQImeRwCMrk_OfVVmY', 'https://drive.google.com/u/0/open?usp=forms_web&id=1TqxtfrS0uC_X8fC19xd7JLcp6wlEmFIG', 'https://drive.google.com/u/0/open?usp=forms_web&id=1RG3L9QCXXpfeAe_hZ7pNFrHpy0fAC_-D'], 'gender' => 'male',
                'birth_date' => '17.07.1984', 'country' => 'Россия', 'city' => 'Октябрьский Башкортостан', 'contact_phone_number' => '89279494398',
                'education_id' => 5, 'place_of_study' => 'Мггу', 'work_position' => 'Инженер по бурению',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Спорт']
            ],

            [
                'phone' => '89165901351', 'email'=>'galiya_ufa@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Галия', 'last_name' => 'Рахимова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1dOCSF2SaWMxCXqPGpK0paGP1M7OmXaaw'], 'gender' => 'female',
                'birth_date' => '19.09.1986', 'country' => 'Россия', 'city' => 'Уфа', 'contact_phone_number' => '89165901351',
                'education_id' => 5, 'place_of_study' => 'МГТУ им. Н.Э.Баумана', 'work_position' => 'Ведущий инженер',
                'place_of_work' => 'Производство оборудования для водоподготовки', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Изучение языков', 'Чтение', 'Плавание']
            ],

            [
                'phone' => '89178867068', 'email'=>'Guzelia.benetton@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гузелия', 'last_name' => 'Мухаметзянова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1IGXMB9MBvwuXMukFH8gSJOQXFkyoZpFi', 'https://drive.google.com/u/0/open?usp=forms_web&id=1x61ZI5-eIHkr3KyWnwY5NysL9TxanneC'], 'gender' => 'female',
                'birth_date' => '15.11.1974', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89178867068',
                'education_id' => 5, 'place_of_study' => 'КГТУ', 'work_position' => 'Продавец -консультант, детская одежда',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Дизайн']
            ],

            [
                'phone' => '89047624380', 'email'=>'gula89047624380@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульсина', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1aCNWgB7XDcKMvLKO0IMVSpApIMT4veML'], 'gender' => 'female',
                'birth_date' => '24.07.1969', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89047624380',
                'education_id' => 4, 'place_of_study' => 'Незаконченное КАИ', 'work_position' => '',
                'place_of_work' => 'Производство', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Шитье', 'Вышивка', 'Вязание']
            ],

            [
                'phone' => '79503142305', 'email'=>'lilya-muslima@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Лилия', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1GEYkuWHYoUTDY2phw66w7ZWsN3d9TkW7'], 'gender' => 'female',
                'birth_date' => '15.11.1983', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79503142305',
                'education_id' => 5, 'place_of_study' => 'Татарский государственный гуманитарно-педагогический университет', 'work_position' => 'Старший научный сотрудник',
                'place_of_work' => 'ФИЦ КазНЦ РАН', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Получение и практика знаний']
            ],

            [
                'phone' => '89179184665', 'email'=>'ilmisan@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ильмира', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1FKLkePdgPUJdMiqjeYgagPR5Syb0m4Cu'], 'gender' => 'female',
                'birth_date' => '15.11.1985', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '89179184665',
                'education_id' => 5, 'place_of_study' => 'Ульяновский государственный университет', 'work_position' => 'Педагог',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Творчество', 'Декор', 'Помощь людям']
            ],

            [
                'phone' => '89172575858', 'email'=>'FazaHan85@ gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Марат', 'last_name' => 'Файзутдинов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=17QaOX_6hf6nl_NyITp8cwYEDmrSrAfl3', 'https://drive.google.com/u/0/open?usp=forms_web&id=1P-iJ68jqQvKwvShehYxyOaz0lLAkt9Y4'], 'gender' => 'male',
                'birth_date' => '15.11.1985', 'country' => 'Россия', 'city' => 'Набережные Челны', 'contact_phone_number' => '89172575858',
                'education_id' => 5, 'place_of_study' => 'КГАМТ, ИНЭКА', 'work_position' => '',
                'place_of_work' => 'В сфере строительства', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Рыбалка', 'Прогулка', 'Плавание']
            ],

            [
                'phone' => '89518999905', 'email'=>'Furtado_b_90@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алсу', 'last_name' => 'Билалова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1JIREcgyEDVQ8e6jCK2mAfjPMiysVtWcX', 'https://drive.google.com/u/0/open?usp=forms_web&id=1WlgfMHIoB0wq5UDzvS75ClvudscOhhpK', 'https://drive.google.com/u/0/open?usp=forms_web&id=1NMfFaualLVAA4nYqZ4xLfAQ5X_6axknl', 'https://drive.google.com/u/0/open?usp=forms_web&id=1a2J4HMA3tVrJakOi0uULyszLjtBC2Onj'], 'gender' => 'female',
                'birth_date' => '15.11.1990', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89518999905',
                'education_id' => 5, 'place_of_study' => 'КХТИ(КНИТУ)', 'work_position' => 'Менеджер',
                'place_of_work' => 'В сфере строительства', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Спорт', 'Бег']
            ],

            [
                'phone' => '89534888036', 'email'=>'lisichka_gulka@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульшат', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=15HG74TpMrgpjM0PJEYYXCUKRPaUrRZwO'], 'gender' => 'female',
                'birth_date' => '17.03.1984', 'country' => 'Россия', 'city' => 'Альметьевск', 'contact_phone_number' => '89534888036',
                'education_id' => 5, 'place_of_study' => 'КАИ им. А.Н.Туполева', 'work_position' => 'Бухгалтер',
                'place_of_work' => 'Коммерческая организация', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Домашние цветы']
            ],

            [
                'phone' => '79872637229', 'email'=>'fraurufabest@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Руфина', 'last_name' => 'Гараева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1v_UJyZ_rH0q_X1xpe2C17HstQt6YVSNp'], 'gender' => 'female',
                'birth_date' => '07.09.1974', 'country' => 'Россия', 'city' => 'Буинск', 'contact_phone_number' => '79872637229',
                'education_id' => 5, 'place_of_study' => 'Ферганский политехнический институт', 'work_position' => 'Зам.главного бухгалтера',
                'place_of_work' => 'Энергетика', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Кулинария', 'Йога', 'Природа', 'Чтение', 'Рукоделие']
            ],

            [
                'phone' => '89172824415', 'email'=>'InfoGaripova@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гарипова', 'last_name' => 'Гульнара',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1xYwZfO3Ao3BZO9vo1-9DiUKJkPb-aCt_', 'https://drive.google.com/u/0/open?usp=forms_web&id=1xwkVjaqwFprlB8DdUtUQp3bO0W1Yg5Ci', 'https://drive.google.com/u/0/open?usp=forms_web&id=1WtaNE-goCTeRSNxO2LX6LZFvtjYmBsVE'], 'gender' => 'female',
                'birth_date' => '15.11.1988', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89172824415',
                'education_id' => 5, 'place_of_study' => 'КамГПИ', 'work_position' => '',
                'place_of_work' => 'Строительство', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Изучение языков', 'Театр', 'Чтение', 'Путешествия', 'Спорт']
            ],

            [
                'phone' => '89166797895', 'email'=>'riz80@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рустам', 'last_name' => 'Измайлов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1sae_jXjPRrsCHSaUjZTy9eBJkDGw3Esn'], 'gender' => 'male',
                'birth_date' => '15.11.1980', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '89166797895',
                'education_id' => 5, 'place_of_study' => 'МГУ им. М.В.Ломоносова', 'work_position' => 'Учитель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Интеллектуальные викторины']
            ],

            [
                'phone' => '79869058418', 'email'=>'minlebaeva29@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алина', 'last_name' => 'Минлебаева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1UwRE-nQYyPm3UgfoDGA21X44kYykqaOx', 'https://drive.google.com/u/0/open?usp=forms_web&id=1x5VhwDVH7qQ2rXVbN0pmIho1niPMnqtN', 'https://drive.google.com/u/0/open?usp=forms_web&id=1Hj-C8XWUGM45t-w5Mp8jHwDOL1GkTm6L'], 'gender' => 'female',
                'birth_date' => '29.08.1980', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79869058418',
                'education_id' => 5, 'place_of_study' => 'КФУ, юрфак, 2002 год', 'work_position' => '',
                'place_of_work' => 'Юриспруденция, благотворительность (в разных организациях, помощь нуждающимся и детям)', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Цветоводство', 'Проводить время на свежем воздухе, в лесу']
            ],

            [
                'phone' => '89274324664', 'email'=>'Alsu@timtech.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алсу', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1EqtfSz5aACNvU6STglHvJADhxxrZ0ftJ'], 'gender' => 'female',
                'birth_date' => '15.11.1989', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274324664',
                'education_id' => 5, 'place_of_study' => 'МарГТУ', 'work_position' => 'Бухгалтер',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Прогулки', 'Посещение концертов', 'Кино']
            ],

            [
                'phone' => '89198439803', 'email'=>'bulgar70@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рафаэль', 'last_name' => 'Нигматуллин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1AW-_c728qSlUzz5kKF3nilyCHxeCn_gL'], 'gender' => 'male',
                'birth_date' => '15.11.1970', 'country' => 'Россия', 'city' => 'Оренбургская обл.г.Орск', 'contact_phone_number' => '89198439803',
                'education_id' => 3, 'place_of_study' => 'Орский машиностроительный техникум', 'work_position' => 'Земледел',
                'place_of_work' => 'В сфере машиностроения', 'marital_status_id' => 1, 'have_children' => true, 'interests' => ['Иностранные языки', 'Велосипед', 'Лыжи', 'Плавание']
            ],

            [
                'phone' => '89375232819', 'email'=>'geltukfet1@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гельгеня', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1B11HjHkUz3pYNRV3zjrzkynLvr4M-Y9K'], 'gender' => 'female',
                'birth_date' => '15.11.1965', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89375232819',
                'education_id' => 4, 'place_of_study' => 'Пединститут', 'work_position' => 'Школа- учитель, театр- администратор',
                'place_of_work' => 'Школа, театр', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Фотографирование природы']
            ],

            [
                'phone' => '89196881252', 'email'=>'B.sultanovna@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Бэлла', 'last_name' => 'Шабняева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=16uzR52JTgZFdixm-3p-dK0ofd0kjsu5M'], 'gender' => 'female',
                'birth_date' => '15.11.1988', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89196881252',
                'education_id' => 5, 'place_of_study' => 'КГТУ им. С.М. Кирова', 'work_position' => '',
                'place_of_work' => 'Производство учебного оборудования', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Велосипед']
            ],

            [
                'phone' => '79655912250', 'email'=>'guz.mel@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гузель', 'last_name' => 'Файзрахманова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1C-baPlxWKNPlH30y2-HPe6osp92oxdYc'], 'gender' => 'female',
                'birth_date' => '05.10.1978', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79655912250',
                'education_id' => 5, 'place_of_study' => 'КГМУ', 'work_position' => '',
                'place_of_work' => 'Медицина', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Вязание', 'Кулинария']
            ],

            [
                'phone' => '79274708664', 'email'=>'dinara.nizamova.1984@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Динара', 'last_name' => 'Низамова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1TJBg1C-VL_qKWLqh3wLFR4SJO_9q_W8r'], 'gender' => 'female',
                'birth_date' => '15.11.1984', 'country' => 'Россия', 'city' => 'Альметьевск', 'contact_phone_number' => '79274708664',
                'education_id' => 5, 'place_of_study' => 'Казанский авиационный институт', 'work_position' => '',
                'place_of_work' => 'Банковская', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение']
            ],

            [
                'phone' => '89274227700', 'email'=>'rv3181@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Руфис', 'last_name' => 'Вахитов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Y-DgFleip1vgCY_9OOOVevVkx25zqUYH'], 'gender' => 'male',
                'birth_date' => '31.05.1981', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274227700',
                'education_id' => 5, 'place_of_study' => 'КГАСУ, КГТУ (2 высших)', 'work_position' => '',
                'place_of_work' => 'Работаю в строительной сфере', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Спортивный зал', 'Отдых на природе']
            ],

            [
                'phone' => '79625619770', 'email'=>'Rinafshaihiev@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ринаф', 'last_name' => 'Шайхиев',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1EtENASp56DYK0V4B_qvfUH-2VOR2f0BJ'], 'gender' => 'male',
                'birth_date' => '29.04.1995', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79625619770',
                'education_id' => 4, 'place_of_study' => 'Продолжаю учиться в РИИ', 'work_position' => 'Хазрат',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Прогулки на природе', 'Заготовки из дерева', 'Футбол']
            ],

            [
                'phone' => '89053122556', 'email'=>'gulsinamh@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульсина', 'last_name' => 'Хуснутдинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1BdQq2iUsA10NMfxCQPX1aMLstHAZr3DE', 'https://drive.google.com/u/0/open?usp=forms_web&id=1woG2DuFP_dIU2VJua2QIn_O9aXtOEFo7', 'https://drive.google.com/u/0/open?usp=forms_web&id=13PnFx_o5V7ZsQMl0AhLcB667obgVdNwo', 'https://drive.google.com/u/0/open?usp=forms_web&id=1gbUOSZFe3lj6shBZASnVOcCzQcNd6pKE', 'https://drive.google.com/u/0/open?usp=forms_web&id=1x4T-XVYjTQ2ZDFKKk4qbzEtaSl2q4-fp', 'https://drive.google.com/u/0/open?usp=forms_web&id=1LTVNnJDnZs2-i-Rp2FZ8Kf0_CqC_sjId'], 'gender' => 'female',
                'birth_date' => '18.11.1974', 'country' => 'Россия', 'city' => 'Зеленодольск', 'contact_phone_number' => '89053122556',
                'education_id' => 5, 'place_of_study' => 'Тгги г. Казани', 'work_position' => 'Служащая, педагог',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Путешествия']
            ],

            [
                'phone' => '79503232740', 'email'=>'Tamilka1991@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Тамиля', 'last_name' => 'Галимуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1P4hmEqYFC41q99j_rHemv5WSNptMYEyl'], 'gender' => 'female',
                'birth_date' => '01.12.1991', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79503232740',
                'education_id' => 5, 'place_of_study' => 'Казанский кооперативный институт', 'work_position' => 'Менеджер',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Предпринимательство']
            ],

            [
                'phone' => '89393905996', 'email'=>'rufina107@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Руфина', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=11lR3C1PxclMJBl1B6-zEsBQyCMjtgh6p'], 'gender' => 'female',
                'birth_date' => '15.11.1990', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89393905996',
                'education_id' => 4, 'place_of_study' => 'КГЭУ', 'work_position' => '',
                'place_of_work' => 'Банк', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Фильмы', 'Книги']
            ],

            [
                'phone' => '88027721718', 'email'=>'shulevmaxim@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Мухаммад', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1JdI0qgy0HUCZZj0SgNKuhlJL57otL1hD', 'https://drive.google.com/u/0/open?usp=forms_web&id=1q2C2SwvjRS3ZvypM5zrOyT-HhJsJBPsg', 'https://drive.google.com/u/0/open?usp=forms_web&id=1H6pdpmU-_ygV7fDeHC0xGzaZPjFRjt6j', 'https://drive.google.com/u/0/open?usp=forms_web&id=1xmm8ybddGI-7G6gttmn0tyhqMN5zKk5S'], 'gender' => 'male',
                'birth_date' => '15.11.1994', 'country' => 'Россия', 'city' => 'Петрозаводск', 'contact_phone_number' => '88027721718',
                'education_id' => 2, 'place_of_study' => '11 классов', 'work_position' => '',
                'place_of_work' => 'Строительство, Благоустройство', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Спорт']
            ],

            [
                'phone' => '89050266884', 'email'=>'a4elmira@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Эльмира', 'last_name' => 'Рустамовна',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1BAa5V5OPuG9_g1jB3q73heBmZGKVrBu4'], 'gender' => 'female',
                'birth_date' => '15.11.1988', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89050266884',
                'education_id' => 5, 'place_of_study' => 'НГЛУ, ВУЗ за рубежом', 'work_position' => '',
                'place_of_work' => 'Сфера образования', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Активный отдых', 'Садоводство', 'Письмо']
            ],

            [
                'phone' => '79991626876', 'email'=>'ilxam_ildarov@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Эльдаров', 'last_name' => 'Ильхам',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Aj3nGgrBiYmIHr5vLsect7jSAonRzcSc', 'https://drive.google.com/u/0/open?usp=forms_web&id=11By6OTyADdZkQrJzxNf-rT1jU-6gfieV'], 'gender' => 'male',
                'birth_date' => '14.05.1996', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79991626876',
                'education_id' => 3, 'place_of_study' => 'Поварское училище', 'work_position' => 'Работаю поваром в кафе',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Велосипед', 'Мотоцикл']
            ],

            [
                'phone' => '89274817754', 'email'=>'nuraniya47@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => '', 'last_name' => 'Мингазутдинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=13Djewxdx4d6OzV0ESYK-6bqT1toj72uP'], 'gender' => 'female',
                'birth_date' => '25.03.1981', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274817754',
                'education_id' => 5, 'place_of_study' => 'КГМУ', 'work_position' => '',
                'place_of_work' => 'Медицина', 'marital_status_id' => 1, 'have_children' => true, 'interests' => ['Путешествия']
            ],

            [
                'phone' => '89172479135', 'email'=>'gul_nk_tr@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульнара', 'last_name' => 'Галимзяновна',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=19MLgoRU9Jd1vaKtMVVUyo8JJLwJ1Xpng'], 'gender' => 'female',
                'birth_date' => '02.03.1981', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89172479135',
                'education_id' => 5, 'place_of_study' => 'НМИ', 'work_position' => '',
                'place_of_work' => 'Отдел кадров', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Кулинария', 'Посадка земли', 'Шитье', 'Вязание'], 'habits'=>['alcohol']
            ],


            [
                'phone' => '89625538786', 'email'=>'Gulnaz_1977@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульназ', 'last_name' => 'Шарафиева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1qvPEJ_jRMw0Zry7aMPTp0qwdrx_9QsiT', 'https://drive.google.com/u/0/open?usp=forms_web&id=1w8DSt7RL7aEUeek1EEufZeFaDWP3OnHz', 'https://drive.google.com/u/0/open?usp=forms_web&id=14lvD-Y_4ivvgLj_q1WQonczY2hYDqtzj'], 'gender' => 'female',
                'birth_date' => '15.11.1977', 'country' => 'Россия', 'city' => 'Республика Татарстан', 'contact_phone_number' => '89625538786',
                'education_id' => 5, 'place_of_study' => 'Казанский государственный университет культуры и искусств', 'work_position' => '',
                'place_of_work' => 'Бизнес', 'marital_status_id' => 1, 'have_children' => true, 'interests' => ['Путешествия']
            ],

            [
                'phone' => '79270345890', 'email'=>'Shamil-galimov@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Шамиль', 'last_name' => 'Галимов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=19UTy9gMIm_ffz1KoJ1VJDQJZBHrjefp2', 'https://drive.google.com/u/0/open?usp=forms_web&id=1XZQm94fhB_loWvEbESEAuzP2XhoKdz1X'], 'gender' => 'male',
                'birth_date' => '15.11.1987', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79270345890',
                'education_id' => 5, 'place_of_study' => 'КФУ', 'work_position' => 'Собственник бизнеса в сфере недвижимости',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Прогулки', 'Общение']
            ],

            [
                'phone' => '89213978737', 'email'=>'bp.xl@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Васил', 'last_name' => 'Абдулов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1I9TBCgWVlt8F9jJdffv9a6bSYtiqO3PH', 'https://drive.google.com/u/0/open?usp=forms_web&id=12tzmeiDDrCeDKcJgUffoHhkNG7NLtfaF', 'https://drive.google.com/u/0/open?usp=forms_web&id=1Bt1MZlTMF6-knvnxT10MwYafvnpjabU8', 'https://drive.google.com/u/0/open?usp=forms_web&id=1rXVz4Qj4vl7qCPzNb_UEfwA5RBblkuq9', 'https://drive.google.com/u/0/open?usp=forms_web&id=1pvBXg6V1LwuVpWggOwUO-ne35-wOkWHT', 'https://drive.google.com/u/0/open?usp=forms_web&id=1gSOv5ZyW7MYlUYtb1tIE22OX6Ty16mVB', 'https://drive.google.com/u/0/open?usp=forms_web&id=1FBl2JR-DmxDufWfbwTBxZhU4ychyt6V4'], 'gender' => 'male',
                'birth_date' => '15.11.1973', 'country' => 'Россия', 'city' => 'Санкт Петербург', 'contact_phone_number' => '89213978737',
                'education_id' => 5, 'place_of_study' => 'ЛГУ', 'work_position' => 'Гостиничный бизнес. Владелец бизнеса',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true
            ],

            [
                'phone' => '89655988152', 'email'=>'anisa285@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Анися', 'last_name' => 'Хусяинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1GfSQsXrYl4SdYBQfCrW_Oqoq7j2-SLJt'], 'gender' => 'female',
                'birth_date' => '15.11.1985', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89655988152',
                'education_id' => 5, 'place_of_study' => 'Современная Гуманитарная Академия', 'work_position' => 'Финансовый консультант',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Кулинария', 'Вышивание', 'Вязание']
            ],

            [
                'phone' => '89172240661', 'email'=>'chudosun@list.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алсу', 'last_name' => 'Ашрапова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1ix97hFRcI_w3fm6uiTOGWac-ejgxPZgg', 'https://drive.google.com/u/0/open?usp=forms_web&id=1tLVJq6nUAsSZTcE_zM0LBO_LBIZ4Xmu0', 'https://drive.google.com/u/0/open?usp=forms_web&id=1lNCZsaN5brJdwWeNdK18FlKIld_lZj4d', 'https://drive.google.com/u/0/open?usp=forms_web&id=1Eyh4ktdzVK7yEPqKwgmax1ctMONoEsVn'], 'gender' => 'female',
                'birth_date' => '20.12.1980', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89172240661',
                'education_id' => 5, 'place_of_study' => 'КГПУ', 'work_position' => 'Образование, преподаватель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение']
            ],

            [
                'phone' => '89033434528', 'email'=>'', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Резеда', 'last_name' => 'Тагировна',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1LzXV4HbtjQE51TPxXGb9YILIkerqiVlg'], 'gender' => 'female',
                'birth_date' => '15.11.1978', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89033434528',
                'education_id' => 5, 'place_of_study' => 'Московский институт', 'work_position' => 'Диспетчер',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Путешествия']
            ],

            [
                'phone' => '89274001202', 'email'=>'Aprel22-01@list.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алсу', 'last_name' => 'Alsu',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1nrbSVkdI5k8HYcqKjv-WpPybmnBUdOSC'], 'gender' => 'female',
                'birth_date' => '15.11.1977', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274001202',
                'education_id' => 4, 'place_of_study' => 'Незаконченное (высшее)', 'work_position' => 'Строительство (менеджер)',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Путешествия', 'Животные']
            ],

            [
                'phone' => '79779548107', 'email'=>'rainbow_5@inbox.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Лале', 'last_name' => 'Саламова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1AHTCKJfh8_JDjfM8eMCxMrXqb73Kcnrg'], 'gender' => 'female',
                'birth_date' => '15.11.1995', 'country' => 'Россия', 'city' => 'Московская область', 'contact_phone_number' => '79779548107',
                'education_id' => 4, 'place_of_study' => 'Рниму им пирогова', 'work_position' => '',
                'place_of_work' => 'Медицина', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Игра на фортепиано', 'Спо']
            ],

            [
                'phone' => '89274281694', 'email'=>'Ajgul81.81@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айгуль', 'last_name' => 'Шакирова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1RkErP5GpucKOi1DA3SMHICdmoW7pJjx5'], 'gender' => 'female',
                'birth_date' => '30.04.1981', 'country' => 'Россия', 'city' => 'Арск', 'contact_phone_number' => '89274281694',
                'education_id' => 5, 'place_of_study' => 'КГСХА', 'work_position' => '',
                'place_of_work' => 'ЖКХ', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Кулинария']
            ],

            [
                'phone' => '79874233933', 'email'=>'Kamillabulat@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Камиля', 'last_name' => 'Мухтарова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1f-CQdHrnKIlNBfpWYAkEqQOEYUv71ff3'], 'gender' => 'female',
                'birth_date' => '12.03.1997', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79874233933',
                'education_id' => 5, 'place_of_study' => 'Казанский медицинский университет, студентка, 5 курс', 'work_position' => 'Студентка',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Фитнес', 'Садоводство']
            ],

            [
                'phone' => '89063237908', 'email'=>'4aisinaskarova8@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айсина', 'last_name' => 'Аскарова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1uN5Q2GjcgfFtcnZ5I8zEElL6E7S2u0Nc'], 'gender' => 'female',
                'birth_date' => '15.11.1998', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89063237908',
                'education_id' => 5, 'place_of_study' => 'ТГГПУ', 'work_position' => '',
                'place_of_work' => 'Торговля', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Пение']
            ],

            [
                'phone' => '89600407600', 'email'=>'sabirova.aighul@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Aigul', 'last_name' => 'Sabir',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1lME4bpcZA9v82sVfMMRv05Nlk0E0DuYk'], 'gender' => 'female',
                'birth_date' => '15.11.1994', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89600407600',
                'education_id' => 5, 'place_of_study' => 'ТГГПУ', 'work_position' => '',
                'place_of_work' => 'В медицинской сфере', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Творчество']
            ],

            [
                'phone' => '89872607670', 'email'=>'rianka030612@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульназ', 'last_name' => 'Мазитова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1R6yPHn25oUZWalz-poryo8Q42OklwVwS', 'https://drive.google.com/u/0/open?usp=forms_web&id=1c81pNWvRtNDci54mjiSiCsIiBT50tJYU'], 'gender' => 'female',
                'birth_date' => '14.02.1983', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89872607670',
                'education_id' => 5, 'place_of_study' => 'КГПУ', 'work_position' => '',
                'place_of_work' => 'Образование', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Кулинария', 'Чтение', 'Обустройство дома']
            ],

            [
                'phone' => '79370049307', 'email'=>'Lilya1704@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Лилия', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1SJjZn9FQAHE6qKTkc5wUXPh9P9XZAbWc'], 'gender' => 'female',
                'birth_date' => '17.04.1984', 'country' => 'Россия', 'city' => 'Республика Татарстан', 'contact_phone_number' => '79370049307',
                'education_id' => 5, 'place_of_study' => 'Альметьевский государственный нефтяной институт экономический факультет. Казанский государственный университет юриспруденция.', 'work_position' => '',
                'place_of_work' => 'Государственное учреждение, кадровая работа', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Кулинария', 'Садоводство', 'Концерты']
            ],

            [
                'phone' => '89376178720', 'email'=>'bulgarrka88@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульнур', 'last_name' => 'Валиуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1s6Ytz6iXUyYBi-ESItEY728ZE6VlBsd3'], 'gender' => 'female',
                'birth_date' => '02.12.1988', 'country' => 'Россия', 'city' => 'поселок в РТ', 'contact_phone_number' => '89376178720',
                'education_id' => 4, 'place_of_study' => 'КФУ', 'work_position' => 'Специалист',
                'place_of_work' => 'Медицина', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Живопись', 'Бег']
            ],

            [
                'phone' => '89274026578', 'email'=>'gulfia73@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульфия', 'last_name' => 'Камалиева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1s6wOD9NhlzI9fb9pYUti6P4Y728vyLoQ'], 'gender' => 'female',
                'birth_date' => '08.09.1973', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89274026578',
                'education_id' => 6, 'place_of_study' => 'Университет, аспирантура', 'work_position' => '',
                'place_of_work' => 'Образование', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Танцы', 'Йога', 'Плавание', 'Музыка', 'Чтение', 'Путешествия']
            ],

            [
                'phone' => '89047644943', 'email'=>'MYNIROV07@GMAIL.COM', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ильшат', 'last_name' => 'Муниров',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1gKEQkYKZUJPI1lt2zFFFQCgjeVrXW08e'], 'gender' => 'male',
                'birth_date' => '19.10.1978', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89047644943',
                'education_id' => 4, 'place_of_study' => 'Военный', 'work_position' => 'Военный',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Спорт']
            ],

            [
                'phone' => '89872388777', 'email'=>'Ajgul.mail@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айгуль', 'last_name' => 'Закирова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1U6wUEs_n6FP1W_kpuf50U824EcmKUmcS'], 'gender' => 'female',
                'birth_date' => '23.10.1987', 'country' => 'Россия', 'city' => 'Чистополь', 'contact_phone_number' => '89872388777',
                'education_id' => 5, 'place_of_study' => 'КГТУ им. А. Н. Туполева', 'work_position' => 'Методист',
                'place_of_work' => 'Управление образования г. Чистополь', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Шитье', 'Написание статей', 'Общественно-полезная деятельность', 'Получение духовных знаний']
            ],

            [
                'phone' => '79520312198', 'email'=>'nazir-turk@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => '', 'last_name' => 'Гареев',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1HSnuhC6taVHhH0DUfY3FSqk3C4HHrPG-'], 'gender' => 'male',
                'birth_date' => '15.11.1990', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79520312198',
                'education_id' => 5, 'place_of_study' => 'КГЭУ магистр', 'work_position' => 'Инженер программист',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Работа', 'Шахматы']
            ],

            [
                'phone' => '89179051525', 'email'=>'aygul.galina.80@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айгуль', 'last_name' => 'Галина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=17MhzYXT5iu6FvI3_rhggsizECS4YcRM1'], 'gender' => 'female',
                'birth_date' => '15.11.1981', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89179051525',
                'education_id' => 5, 'place_of_study' => 'КГТУ', 'work_position' => 'Повар',
                'place_of_work' => 'Общепит', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Спорт']
            ],

            [
                'phone' => '89297278724', 'email'=>'alsu7000@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алсу', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1eg6iqPL7Iuw10SueffoDE3DYXViF4dBG'], 'gender' => 'female',
                'birth_date' => '16.02.1991', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89297278724',
                'education_id' => 5, 'place_of_study' => 'КГУ', 'work_position' => 'Биолог',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Рисование', 'Шитье']
            ],

            [
                'phone' => '79534826243', 'email'=>'ruslan.magassumov@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Руслан', 'last_name' => 'Магасумов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1ELKa6DGyzYGRryAJGdP4ezqjCbzTNmDd'], 'gender' => 'male',
                'birth_date' => '15.11.1989', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79534826243',
                'education_id' => 5, 'place_of_study' => 'КазАТУ', 'work_position' => '', 'habits'=>['alcohol'],
                'place_of_work' => 'Строительство (проектирование)', 'marital_status_id' => 1, 'have_children' => false
            ],

            [
                'phone' => '89393499601', 'email'=>'di_koznova@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Диана', 'last_name' => 'Кознова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Z6a242QhyTcZvM8CEJqAfOdke5h6giau'], 'gender' => 'female',
                'birth_date' => '23.07.1997', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89393499601',
                'education_id' => 5, 'place_of_study' => 'Казанский инновационный университет', 'work_position' => 'Логопед-дефектолог, воспитатель',
                'place_of_work' => 'В педагогической сфере', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Просмотр фильмов', 'Природа', 'Велосипед', 'Лыжи']
            ],

            [
                'phone' => '89375930967', 'email'=>'guzalia.salimova@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гузалия', 'last_name' => 'Салимова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1p8cr7Lm4U_UWZXOZJhhXS-lNTLigPjcl', 'https://drive.google.com/u/0/open?usp=forms_web&id=1GR_8684fgSduIA7btWbq8bc9FiuIh7AY', 'https://drive.google.com/u/0/open?usp=forms_web&id=1hWsQXL-5uaAN5zk1vmEATe0Wy38_AXsv'], 'gender' => 'female',
                'birth_date' => '23.07.1997', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89375930967',
                'education_id' => 5, 'place_of_study' => 'Уральский педагогический университет, Башкирский государственный университет', 'work_position' => 'Юрисконсульт, преподаватель',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение']
            ],

            [
                'phone' => '89625507159', 'email'=>'Khusainovaregina@rambler.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Регина', 'last_name' => 'Хусаинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1KcLA0-AmS0PJbXjQSzvAzKE3o0YV56T6'], 'gender' => 'female',
                'birth_date' => '15.11.1992', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89625507159',
                'education_id' => 5, 'place_of_study' => 'Казанский Приволжский Федеральный университет', 'work_position' => 'Специалист',
                'place_of_work' => 'Минсельхозпрод РТ', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Спорт', 'Танцы']
            ],

            [
                'phone' => '89179122841', 'email'=>'Davletshin-1979@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рамиль', 'last_name' => 'Давлетшин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1nRBWEA3oObHDiCJZaoltKgdh5NtRYr8a', 'https://drive.google.com/u/0/open?usp=forms_web&id=1UHEliGd2lGUBPgP-bLZtM95Xp-csCui2', 'https://drive.google.com/u/0/open?usp=forms_web&id=1AMBmxY1A1Ej6z3kN4XfFYIC5Ydwky-PT'], 'gender' => 'male',
                'birth_date' => '11.12.1979', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89179122841',
                'education_id' => 5, 'place_of_study' => 'КГЭУ', 'work_position' => 'Тренер, в спортивной сфере',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Спорт', 'Лошади', 'Футбол']
            ],

            [
                'phone' => '89376144924', 'email'=>'Lenikeeva.ip@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Лилия', 'last_name' => 'Еникеева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1V2AqLUJMlxQsXrLjBdT0xnRwzAdO6j7n'], 'gender' => 'female',
                'birth_date' => '04.10.1990', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '89376144924',
                'education_id' => 5, 'place_of_study' => 'КГФЭИ', 'work_position' => 'Бухгалтер',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Рисование']
            ]
        ];*/
        $users = [
            [
                'phone' => '79661721235', 'email'=>'i.riahimov@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ринат', 'last_name' => 'Абдуллин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1NpCMQ-0VP3RahPO3k4jitmuKZBwZ3dFN'], 'gender' => 'male',
                'birth_date' => '24.11.1985', 'country' => 'Россия', 'city' => 'Пенза', 'contact_phone_number' => '79661721235',
                'education_id' => 5, 'place_of_study' => 'Педагогический институт', 'work_position' => '', 'habits'=>['alcohol'],
                'place_of_work' => 'Охрана', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Футбол']
            ],
            [
                'phone' => '79263549031', 'email'=>'rin135sh@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ринат', 'last_name' => 'Шазизов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1WevPz2uHw0g8zkr4rzpLmbHBjIvR6C4_', 'https://drive.google.com/u/0/open?usp=forms_web&id=1FiOEUWDwcyOccyBllh668LvCN0N_Y5Vz'], 'gender' => 'male',
                'birth_date' => '17.04.1980', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79263549031',
                'education_id' => 4, 'place_of_study' => 'Н/В', 'work_position' => 'Специалист по лазерам',
                'place_of_work' => 'Производство', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Инвестиции']
            ],
            [
                'phone' => '79053734719', 'email'=>'gulaok@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульнара', 'last_name' => 'Гарифуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1UMkvyl4hWQD_0CRfrKx2zvvvG7c75mZZ'], 'gender' => 'female',
                'birth_date' => '01.12.1976', 'country' => 'Россия', 'city' => 'Набережные челны', 'contact_phone_number' => '79053734719',
                'education_id' => 5, 'place_of_study' => 'Казанский государственный университет', 'work_position' => 'Мастер ногтевого сервиса',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['увлекаюсь всем']
            ],
            [
                'phone' => '79513583312', 'email'=>'ramil4ik.ramil58@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рамиль', 'last_name' => 'Туишев',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1DZjAH2Vt7jdGn9pDErYBwSRWNSl44gpM'], 'gender' => 'male',
                'birth_date' => '20.12.1995', 'country' => 'Россия', 'city' => 'Пенза', 'contact_phone_number' => '79513583312',
                'education_id' => 5, 'place_of_study' => 'ПГУ', 'work_position' => 'Логист', 'habits'=>['other'],
                'place_of_work' => 'Сфера обслуживания', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Авто']
            ],
            [
                'phone' => '79873464109', 'email'=>'ramilka2106@icloud.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рамиля', 'last_name' => 'Валиуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1-EFM5_UlU9rXQ8zB80WXUg-kT92cGOGB', 'https://drive.google.com/u/0/open?usp=forms_web&id=1sFqC7PMhNFmkSOS8JJL2jke_IC2qG4Ab', 'https://drive.google.com/u/0/open?usp=forms_web&id=1uppBkjgMZkIdy1DoWk6thWXN8i7l-j7Y', 'https://drive.google.com/u/0/open?usp=forms_web&id=1427DyB8qDFZo9AFTYaXj0iulnczX9RgW'], 'gender' => 'female',
                'birth_date' => '01.12.1990', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79873464109',
                'education_id' => 5, 'place_of_study' => 'Оренбургский Государственный Аграрный Университет', 'work_position' => 'Юрист',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Активный отдых']
            ],
            [
                'phone' => '79871465561', 'email'=>'ajgul.usm@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Айгуль', 'last_name' => 'Усманова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1kRfeeuk5dqAPtQx8OMc3fuap25Q4n7He'], 'gender' => 'female',
                'birth_date' => '13.11.1970', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79871465561',
                'education_id' => 3, 'place_of_study' => '', 'work_position' => 'Диетсестра', 'habits'=>['alcohol'],
                'place_of_work' => 'Медицина', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Вязание']
            ],
            [
                'phone' => '79600397080', 'email'=>'marat.xxx3@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Марат', 'last_name' => 'Валиев',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1DpixmUxd44_3cngsuJfLbXHbO66Vsl6Y', 'https://drive.google.com/u/0/open?usp=forms_web&id=1RPC1exPROa7RSmTRL_XHSC_z6CQJYYH8'], 'gender' => 'male',
                'birth_date' => '01.12.1979', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79600397080',
                'education_id' => 3, 'place_of_study' => '', 'work_position' => '', 'habits'=>['other'],
                'place_of_work' => 'Малый бизнес', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Мото']
            ],
            [
                'phone' => '79154265577', 'email'=>'777g777r@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульнара', 'last_name' => 'Юсупова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1rc2j7L6Swo2bgXO88bUQcbGRNwaq_BKE', 'https://drive.google.com/u/0/open?usp=forms_web&id=1araDDkftF1ofyDN0UlToA7zN4ILGcf8I', 'https://drive.google.com/u/0/open?usp=forms_web&id=1yxMKhoiE5hedg93-by2pUPYk665XYYbs'], 'gender' => 'female',
                'birth_date' => '01.12.1982', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79154265577',
                'education_id' => 5, 'place_of_study' => '', 'work_position' => '',
                'place_of_work' => 'Медицина', 'marital_status_id' => 1, 'have_children' => false
            ],
            [
                'phone' => '79033402540', 'email'=>'gadem911@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Адель', 'last_name' => 'Гайнутдинов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1olnH5CYSVSgzPqEJKt_lwYnhSxcCLD8Z'], 'gender' => 'male',
                'birth_date' => '01.12.1994', 'country' => 'Россия', 'city' => 'Мытищи', 'contact_phone_number' => '79033402540',
                'education_id' => 5, 'place_of_study' => 'КНИТУ-КАИ', 'work_position' => 'Инженер-программист', 'habits'=>['other'],
                'place_of_work' => 'В сфере образования', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Чтение', 'Психология', 'Кататься на лыжах']
            ],
            [
                'phone' => '79267576966', 'email'=>'rameliya90@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рамиля', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1J4k5_lOhJt-ri4g4T6EKuLlPXmrsmU05'], 'gender' => 'female',
                'birth_date' => '01.12.1990', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79267576966',
                'education_id' => 5, 'place_of_study' => 'ВГАВТ', 'work_position' => 'Экономист',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Прогулки на свежем воздухе']
            ],
            [
                'phone' => '79262564011', 'email'=>'sanij19@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Сания', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1lSqM8oXE0EZmlan8CQv_RC0GQSWfKOo'], 'gender' => 'female',
                'birth_date' => '01.12.1969', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79262564011',
                'education_id' => 3, 'place_of_study' => 'Техникум', 'work_position' => '',
                'place_of_work' => 'Торговля', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Плавание', 'Танцы']
            ],
            [
                'phone' => '79777186550', 'email'=>'galiya.aisit@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Галия', 'last_name' => 'Айситулина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1w8UGwswK7fVZkHVcFvtbxs8svFzIxDzB', 'https://drive.google.com/u/0/open?usp=forms_web&id=1DApgXF5asAkSl9oJiqjcKLCrLQy1RHIe'], 'gender' => 'female',
                'birth_date' => '14.07.1970', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79777186550',
                'education_id' => 5, 'place_of_study' => '', 'work_position' => 'Косметолог',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Путешествия', 'Лечить', 'Красоту дарить']
            ],
            [
                'phone' => '79067363482', 'email'=>'Masrus@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Нагим', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1XfZp6Stb4MI4c7On9fDE7xQcV5rQyVJS'], 'gender' => 'male',
                'birth_date' => '01.12.1961', 'country' => 'Россия', 'city' => 'Балашиха', 'contact_phone_number' => '79067363482',
                'education_id' => 5, 'place_of_study' => 'ТаиИИТ', 'work_position' => 'Жд инженер',
                'place_of_work' => 'Жд', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Футбол']
            ],
            [
                'phone' => '79047627345', 'email'=>'gmalik45@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульнара', 'last_name' => 'Маликова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1eM1rXCQLKn5eTChBHe8YU8g80D9MNkm-'], 'gender' => 'female',
                'birth_date' => '01.03.1973', 'country' => 'Россия', 'city' => 'Санкт - Петербург', 'contact_phone_number' => '79047627345',
                'education_id' => 5, 'place_of_study' => 'Московский государственный социальный университет', 'work_position' => '',
                'place_of_work' => 'Медицина, психология, бизнес', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Путешествия', 'Психология', 'Готовка', 'Домашние цветы', 'Чтение']
            ],
            [
                'phone' => '79091757478', 'email'=>'alina241011@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алена', 'last_name' => 'Ковригина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1_2EjWkesho3nlQMXeZF7wV4aBsdQvSWD'], 'gender' => 'female',
                'birth_date' => '18.07.1977', 'country' => 'Россия', 'city' => 'Курганская область', 'contact_phone_number' => '79091757478',
                'education_id' => 5, 'place_of_study' => 'КГУ', 'work_position' => '',
                'place_of_work' => 'Культура', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Кулинария']
            ],
            [
                'phone' => '79652528910', 'email'=>'alsutagirova695@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альмируша', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1AuvBGXUEc9-vr86nOIF5YAJnLWHoOvCM'], 'gender' => 'female',
                'birth_date' => '01.12.1971', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79652528910',
                'education_id' => 5, 'place_of_study' => 'Огу', 'work_position' => '', 'habits'=>['other'],
                'place_of_work' => 'Социальная сфера', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение']
            ],
            [
                'phone' => '79222832330', 'email'=>'renat.dolotkazun@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ринат', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=19Ik4WaITSG_inv8jvJ3W5Y-VRNuz96Qo', 'https://drive.google.com/u/0/open?usp=forms_web&id=1FFGxBCzFJafm-EAyzxnn_4Vskki7u26J'], 'gender' => 'male',
                'birth_date' => '13.02.1975', 'country' => 'Россия', 'city' => 'Татарстан', 'contact_phone_number' => '79222832330',
                'education_id' => 3, 'place_of_study' => 'Коледж', 'work_position' => '', 'habits'=>['alcohol'],
                'place_of_work' => 'Строительство', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Рыбалка']
            ],
            [
                'phone' => '79104693265', 'email'=>'Ilsyr112@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ильсур', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=12xUwIDXnMqGF9Hz9XyWMgnmmwbthkOL5'], 'gender' => 'male',
                'birth_date' => '01.12.1991', 'country' => 'Россия', 'city' => 'Татарстан', 'contact_phone_number' => '79104693265',
                'education_id' => 5, 'place_of_study' => 'ГУУ', 'work_position' => 'Руководитель среднего звена',
                'place_of_work' => 'Теплоэнергетика', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Плавание']
            ],
            [
                'phone' => '79254879494', 'email'=>'7792362@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ринат', 'last_name' => 'Биктимиров',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1dRZTHzvPb0eUxIqA8w5Mx_63fouX7PND', 'https://drive.google.com/u/0/open?usp=forms_web&id=1S1VNlqc2Sk4ZJLmmoBd8TIsw1GIrPaYZ', 'https://drive.google.com/u/0/open?usp=forms_web&id=1yfipsnriE-t7u8RdmLkpRXOnqDKLkNYj'], 'gender' => 'male',
                'birth_date' => '01.12.1984', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79254879494',
                'education_id' => 4, 'place_of_study' => 'Казанское высшее военное училище', 'work_position' => 'Начальник отдела', 'habits'=>['other'],
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Велоспорт', 'Диджеинг']
            ],
            [
                'phone' => '79992144967', 'email'=>'maysungiza@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Фаина', 'last_name' => 'Гизатулина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1HNe9kNXQwtJlRqM9tmf5pAzl8e-_O0Wd'], 'gender' => 'female',
                'birth_date' => '01.12.1997', 'country' => 'Россия', 'city' => 'Санкт-Петербург', 'contact_phone_number' => '79992144967',
                'education_id' => 3, 'place_of_study' => 'Медицинский колледж 1', 'work_position' => 'Парикмахер',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Йога']
            ],
            [
                'phone' => '79153298385', 'email'=>'ravilchik06@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Равиль', 'last_name' => 'Невретдинов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1vJSqjLEAc8TtqURwXmrySsbaG03gbLv0'], 'gender' => 'male',
                'birth_date' => '01.12.1983', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79153298385',
                'education_id' => 5, 'place_of_study' => 'Мипп', 'work_position' => 'Юрист',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Хоккей']
            ],
            [
                'phone' => '79518986642', 'email'=>'Islamiya.Hisamova@tatar.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Исламия', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1o4rA44yEtZ105ZmQsEX463TVtpL1p4uX'], 'gender' => 'female',
                'birth_date' => '01.12.1985', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79518986642',
                'education_id' => 5, 'place_of_study' => 'КГУ', 'work_position' => '',
                'place_of_work' => 'Медицинская организация', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Земледелие']
            ],
            [
                'phone' => '79379199029', 'email'=>'romanikhina98@bk.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Карина', 'last_name' => 'Романихина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1e-cGClzfMQHGXzR1AzolJqXkk5utk-iv'], 'gender' => 'female',
                'birth_date' => '26.11.1986', 'country' => 'Россия', 'city' => 'Каменка', 'contact_phone_number' => '79379199029',
                'education_id' => 5, 'place_of_study' => 'ПГПУ им. В. Г. Белинского', 'work_position' => '',
                'place_of_work' => 'Бюджет', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Дом']
            ],
            [
                'phone' => '79372195502', 'email'=>'gulsum_rr@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гульсум', 'last_name' => 'Рахматуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1emuWgQLrvAw3u6akHIRHW2QswLE-JxjX'], 'gender' => 'female',
                'birth_date' => '01.12.1982', 'country' => 'Россия', 'city' => 'Тольятти', 'contact_phone_number' => '79372195502',
                'education_id' => 5, 'place_of_study' => 'Московский гос. соц. университет', 'work_position' => '',
                'place_of_work' => 'Бухгалтерия', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Работа']
            ],
            [
                'phone' => '79114904373', 'email'=>'zaletdinovrust@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рустам', 'last_name' => 'Залетдинов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=15U0ap4tyd08eeX4mi5gpwssqXbm0xVku'], 'gender' => 'male',
                'birth_date' => '03.04.1978', 'country' => 'Россия', 'city' => 'Гурьевск, Калининградская область', 'contact_phone_number' => '79114904373',
                'education_id' => 5, 'place_of_study' => 'ТИТЛП, КГТУ', 'work_position' => '',
                'place_of_work' => 'Производство', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Чтение', 'Баскетбол']
            ],
            [
                'phone' => '79655832622', 'email'=>'93.alina777@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алина', 'last_name' => 'Мустафина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1t_ZyZIokXyyWAfLpJ8d9FzLoAGl_wRF7'], 'gender' => 'female',
                'birth_date' => '06.04.1993', 'country' => 'Россия', 'city' => 'Казань, Ново-Савиновский р-он', 'contact_phone_number' => '79655832622',
                'education_id' => 5, 'place_of_study' => 'ИСГЗ', 'work_position' => 'Экономист',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Кататься на коньках', 'Вязание крючком']
            ],
            [
                'phone' => '79111704430', 'email'=>'Mrguzel@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Гузель', 'last_name' => 'Мирсагатова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=19whbaphBDt3M6dIRpYpbZ-Fui7QSvUro', 'https://drive.google.com/u/0/open?usp=forms_web&id=1XccK-WIEcdyuAFuZByBpx-cJ1pEidM_a', 'https://drive.google.com/u/0/open?usp=forms_web&id=18__xda--IfMy2fsfbH0LSC1bjzYIrnDE', 'https://drive.google.com/u/0/open?usp=forms_web&id=1qFxCeHUXqzBQzL7gPI7bQyJia_NxLJwE', 'https://drive.google.com/u/0/open?usp=forms_web&id=17_XTe4dantotnCPZRx4FyPSYG6wztrqS'], 'gender' => 'female',
                'birth_date' => '11.03.1969', 'country' => 'Россия', 'city' => 'Санкт-петербург', 'contact_phone_number' => '79111704430',
                'education_id' => 5, 'place_of_study' => 'Лиижт', 'work_position' => '',
                'place_of_work' => 'Недвижимость', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Путешествия']
            ],
            [
                'phone' => '79119795909', 'email'=>'rimma1105@rambler.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Римма', 'last_name' => 'Гарифуллина',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1sQGB-p8nAAY1m-Erayltvy2cpIVf3Kg0', 'https://drive.google.com/u/0/open?usp=forms_web&id=1IdyAjn87n3B_4hUVRSECptWxwpZT-6hW'], 'gender' => 'female',
                'birth_date' => '16.01.1964', 'country' => 'Россия', 'city' => 'Санкт-Петербург', 'contact_phone_number' => '79119795909',
                'education_id' => 5, 'place_of_study' => 'Ленинградский институт авиационного приборостроения', 'work_position' => 'Руководитель НКО',
                'place_of_work' => 'Благотворительность', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Народно-прикладное творчество']
            ],
            [
                'phone' => '79271337395', 'email'=>'Allaivakhnenko@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Алла', 'last_name' => 'Ивахненко',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1RdFY2lWTgPW1maE8fUZtSesmc9Tb-kDS', 'https://drive.google.com/u/0/open?usp=forms_web&id=19QZszdDowsW9XUev6IZe_wi3HLKN0L2R'], 'gender' => 'female',
                'birth_date' => '22.10.1992', 'country' => 'Россия', 'city' => 'Химки', 'contact_phone_number' => '79271337395',
                'education_id' => 5, 'place_of_study' => 'СГУ им. Н.Г Чернышевского. философский факультет', 'work_position' => 'Педагог',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Вокал']
            ],
            [
                'phone' => '79650374361', 'email'=>'john72355@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альфис', 'last_name' => 'Ибатуллин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1gyZ7wj9dajm6TUUIEiUgHWqRkEXKM-aP'], 'gender' => 'male',
                'birth_date' => '01.12.1982', 'country' => 'Россия', 'city' => 'Санкт-Петербург', 'contact_phone_number' => '79650374361',
                'education_id' => 5, 'place_of_study' => 'ЛТА', 'work_position' => 'Предприниматель',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Велосипед']
            ],
            [
                'phone' => '79521105998', 'email'=>'sycheeva@list.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Альбина', 'last_name' => 'Сычева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1-pyR3Z70BHhcKjBq6xfjhmJc24vnzGyC'], 'gender' => 'female',
                'birth_date' => '03.05.1962', 'country' => 'Россия', 'city' => 'Калининград', 'contact_phone_number' => '79521105998',
                'education_id' => 5, 'place_of_study' => 'Зоотехническое педагогическое', 'work_position' => 'Не работаю',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Вязание', 'Рукоделие']
            ],
            [
                'phone' => '79055899903', 'email'=>'rustamkaa@list.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рустам', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Qa6ypvHdcGMjwl9_oIrCSuEF8GchK3WH'], 'gender' => 'male',
                'birth_date' => '01.12.1987', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79055899903',
                'education_id' => 5, 'place_of_study' => 'МГИУ', 'work_position' => 'Юрист',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Футбол', 'Теннис', 'Плавание', 'Турник', 'Велосипед', 'Чтение']
            ],
            [
                'phone' => '79254349880', 'email'=>'jgjb9351@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Евгений', 'last_name' => 'Заболотный',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1W3Df7L3PtBSFWlQmytaD5sue5Q1mTPq1'], 'gender' => 'male',
                'birth_date' => '05.05.1993', 'country' => 'Россия', 'city' => 'Село Ташлык', 'contact_phone_number' => '79254349880',
                'education_id' => 5, 'place_of_study' => 'ПГУ им. Т. Г. Шевченко', 'work_position' => '',
                'place_of_work' => 'Розничная торговля', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Единоборства']
            ],
            [
                'phone' => '79210942221', 'email'=>'roza12345678@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Роза', 'last_name' => 'Фалалеева',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1weZ02KGjvosPd3Y2M3INOLhxGiqReqwr', 'https://drive.google.com/u/0/open?usp=forms_web&id=1qoeJzWfQ3HMVongoJ1hYhgHXI1RqkX7B'], 'gender' => 'female',
                'birth_date' => '14.06.1960', 'country' => 'Россия', 'city' => 'Санкт-Петербург', 'contact_phone_number' => '79210942221',
                'education_id' => 5, 'place_of_study' => 'Университет', 'work_position' => 'Психолог',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Путешествия']
            ],
            [
                'phone' => '79600475856', 'email'=>'sabirov.fargat@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Фаргат', 'last_name' => 'Сабиров',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1YroCqCe4iWyMq5aZI3P4RqJIe46MAbXs', 'https://drive.google.com/u/0/open?usp=forms_web&id=1ryXRiDpt0cYtLBqkrU1VPg8-Eee0cgOS'], 'gender' => 'male',
                'birth_date' => '11.06.1987', 'country' => 'Россия', 'city' => 'Арск', 'contact_phone_number' => '79600475856',
                'education_id' => 3, 'place_of_study' => 'Арский педагогический колледж', 'work_position' => 'Комплектовщик',
                'place_of_work' => 'Молочный склад', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Требование знания']
            ],
            [
                'phone' => '79378500398', 'email'=>'N1a9i8l3@rambler.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Наиль', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=11hhYvReU8_UgSlg4wRWLBRrPS2vmmR5P'], 'gender' => 'male',
                'birth_date' => '23.11.1983', 'country' => 'Россия', 'city' => 'РБ', 'contact_phone_number' => '79378500398',
                'education_id' => 5, 'place_of_study' => 'Педагогическое', 'work_position' => '',  'habits'=>['alcohol'],
                'place_of_work' => 'Образовательное', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Прогулки']
            ],
            [
                'phone' => '79673707608', 'email'=>'Zugrya- 2011@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Зугря', 'last_name' => 'Саитбатталова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1N9g_PeMWfrgTICcAa-dpo3qN3cVzUHcl'], 'gender' => 'female',
                'birth_date' => '17.10.1958', 'country' => 'Россия', 'city' => 'ПГТ \"Васильево\" РТ.', 'contact_phone_number' => '79673707608',
                'education_id' => 5, 'place_of_study' => 'АГТУ', 'work_position' => 'Педагог (на пенсии)',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Кроссворды', 'Шахматы', 'Искусство']
            ],
            [
                'phone' => '79198897969', 'email'=>'Hodokk@inbox.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Фярит', 'last_name' => 'Зинатулин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1oOZFfTLDn8EhCv_mOY93u5bR6CX2ywmt'], 'gender' => 'male',
                'birth_date' => '01.12.1985', 'country' => 'Россия', 'city' => 'Ростов на Дону', 'contact_phone_number' => '79198897969',
                'education_id' => 2, 'place_of_study' => '', 'work_position' => 'Слесарь', 'habits'=>['other'],
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение']
            ],
            [
                'phone' => '79600483823', 'email'=>'nakipov.rustem@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рустем', 'last_name' => 'Накипов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1EeF0SBjP8xudzmphSGdN4Y8cCkCON3H7', 'https://drive.google.com/u/0/open?usp=forms_web&id=18ydg4bSL0XbrnZzW00SICOiHa1fiM3bS'], 'gender' => 'male',
                'birth_date' => '01.12.1967', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79600483823',
                'education_id' => 3, 'place_of_study' => '', 'work_position' => 'Водитель',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Спорт', 'Дача', 'Природа']
            ],
            [
                'phone' => '79992049450', 'email'=>'Salyamiskak@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Искак', 'last_name' => 'Салямов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1BppZGWtFI7i7_vvn3_JbU7bRMjpn2gsK', 'https://drive.google.com/u/0/open?usp=forms_web&id=1GgnyQpms20MiVlmzvagfZg5CIOjpWTqM'], 'gender' => 'male',
                'birth_date' => '29.05.93', 'country' => 'Россия', 'city' => 'Пенза', 'contact_phone_number' => '79992049450',
                'education_id' => 5, 'place_of_study' => 'ГБОУ СПО ПК 33', 'work_position' => '', 'habits'=>['other'],
                'place_of_work' => 'ВС РФ', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Футбол', 'Гитара', 'Отдых на природе', 'Рыбалка']
            ],
            [
                'phone' => '79062162311', 'email'=>'kamirit@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Фарит', 'last_name' => 'Садретдинов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1yzPUYp7eqOYUMleotHNwCrjPUbf_RMNY', 'https://drive.google.com/u/0/open?usp=forms_web&id=1k1rkbpe_5UKw9O6sZ8S6fCsXTrKpVn_Z', 'https://drive.google.com/u/0/open?usp=forms_web&id=1_7Ol3ZjQ8FAgvNMUir7UTeu5u6RDC-z3', 'https://drive.google.com/u/0/open?usp=forms_web&id=1LPZQR1bYAiShX9HmRYxqVrOakHBOOLBV'], 'gender' => 'male',
                'birth_date' => '01.12.1974', 'country' => 'Россия', 'city' => 'Калининград', 'contact_phone_number' => '79062162311',
                'education_id' => 5, 'place_of_study' => 'МЭСИ Московский университет', 'work_position' => 'Индивидуальный  предприниматель',
                'place_of_work' => 'Магазин одежды', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Фитнес', 'Теннис', 'Путешествия']
            ],
            [
                'phone' => '79110067432', 'email'=>'mail@yusupof.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Тимур', 'last_name' => 'Юсупов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Uxtg506-3NiU33JevD_bKh8mFundmzpk'], 'gender' => 'male',
                'birth_date' => '01.12.1979', 'country' => 'Россия', 'city' => 'Санкт-Петербург', 'contact_phone_number' => '79110067432',
                'education_id' => 5, 'place_of_study' => 'Образования в сфере управления, государственного и муниципального управления в сфере национальной безопасности и педагогики и психологии', 'work_position' => '',
                'place_of_work' => 'Делаю онлайн-курсы по научному саморазвитию и психологии, веду познавательную программу в соцсетях', 'marital_status_id' => 1, 'have_children' => true, 'interests' => ['Самообразование', 'Путешествия', 'Общение', 'Йога', 'Публицистика']
            ],
            [
                'phone' => '79650805474', 'email'=>'lolaspb358@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Лола', 'last_name' => 'Жалолова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1vcyg67KFWo9TMg2IJuVD68Nx-hXN84bg', 'https://drive.google.com/u/0/open?usp=forms_web&id=1Mf4w2e6bG2RQbrVayb-ODBMKxNwLw_rR', 'https://drive.google.com/u/0/open?usp=forms_web&id=1EM648HK6BjOiJnV6xXHV-iTX7XZVXTks'], 'gender' => 'female',
                'birth_date' => '08.09.1981', 'country' => 'Россия', 'city' => 'Санкт-Петербург', 'contact_phone_number' => '79650805474',
                'education_id' => 4, 'place_of_study' => 'СпбГУТД', 'work_position' => 'Дизайнер',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Дизайн одежды', 'Времяпрепровождение с детьми', 'Путешествия', 'Получение новых навыков и знаний в различных сферах']
            ],
            [
                'phone' => '905523031352', 'email'=>'medınamumına12@gmaıl.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Мадина', 'last_name' => 'Мухаметали',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Cgilbze6ElxDj_tMbmBvLhGQGnK7OvBo', 'https://drive.google.com/u/0/open?usp=forms_web&id=1rbXfcQ251wk3BQ7k0w4PJDcNJ5bpFBqn', 'https://drive.google.com/u/0/open?usp=forms_web&id=1v2oQ66QUBqmb6S1Jkuqjo2ifvfVmrRIi'], 'gender' => 'female',
                'birth_date' => '04.09.1988', 'country' => 'Турция', 'city' => 'Анталия', 'contact_phone_number' => '905523031352',
                'education_id' => 5, 'place_of_study' => 'Юридическое', 'work_position' => 'Специалист по недвижимости',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => false, 'interests' => ['Плавание', 'Прогулки']
            ],
            [
                'phone' => '79035692350', 'email'=>'cyprus-good@yandex.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Рашит', 'last_name' => 'Фахретдинов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1Ywzzo_febqa1ZVXgiFheUB02C_BUZ--0', 'https://drive.google.com/u/0/open?usp=forms_web&id=1ejtJ3k-Uww-BvL0y99unMzUCnypzyRCk', 'https://drive.google.com/u/0/open?usp=forms_web&id=1nafUpl-fLBGoqhSnaMa3BJvrw8rUQsyY'], 'gender' => 'male',
                'birth_date' => '12.02.1982', 'country' => 'Россия', 'city' => 'Москва', 'contact_phone_number' => '79035692350',
                'education_id' => 5, 'place_of_study' => 'МГГУ', 'work_position' => 'Тренер по боксу',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Спорт']
            ],
            [
                'phone' => '79377793368', 'email'=>'trifolegssz@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Олег', 'last_name' => 'Трифонов',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1bnTA08P-joTRRcXROjY4LfceBuu7cAA7'], 'gender' => 'male',
                'birth_date' => '14.02.1963', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79377793368',
                'education_id' => 4, 'place_of_study' => '', 'work_position' => 'Хозяин',
                'place_of_work' => 'Собственное дело', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Рисование', 'Стихи', 'Велосипед', 'Плавание', 'Баня', 'Поездки по озерам', 'Закаливание', 'Теннис', 'Волейбол']
            ],
            [
                'phone' => '79178715872', 'email'=>'elmirag472@gmail.com', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Эльмира', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1jkNe02D-myq5zSmo2gXeg1lhDeHAhkNS'], 'gender' => 'female',
                'birth_date' => '13.01.1974', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79178715872',
                'education_id' => 5, 'place_of_study' => 'КГПУ', 'work_position' => 'Учитель',
                'place_of_work' => '', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Готовка', 'Путешествия']
            ],
            [
                'phone' => '79297286303', 'email'=>'ENIKEEV.020984@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Радик', 'last_name' => '',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1eW2xzZNFDtut8byFVkX4CqJYWqJLv9KC'], 'gender' => 'male',
                'birth_date' => '01.12.1984', 'country' => 'Россия', 'city' => 'Васильево', 'contact_phone_number' => '79297286303',
                'education_id' => 5, 'place_of_study' => 'ВУЗ', 'work_position' => '',
                'place_of_work' => 'Грузоперевозки', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Спорт']
            ],
            [
                'phone' => '79372939000', 'email'=>'rks7878@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Ринат', 'last_name' => 'Сибгатуллин',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1CAof8OTSjK2TewB2ixgk-CxmbP5DNSRe', 'https://drive.google.com/u/0/open?usp=forms_web&id=11rlqve8IaEPiEFC6zIufYsbEEP1meD0j', 'https://drive.google.com/u/0/open?usp=forms_web&id=1YcRw1YXU3P03qrRjDAGSoHZtHnWM6fY7'], 'gender' => 'male',
                'birth_date' => '02.07.1978', 'country' => 'Россия', 'city' => 'Казань, Челны', 'contact_phone_number' => '79372939000',
                'education_id' => 5, 'place_of_study' => 'КГУ (КамПИ, сегодня филиал КГУ)', 'work_position' => 'Коммерческий директор',
                'place_of_work' => 'Транспорт', 'marital_status_id' => 3, 'have_children' => true, 'interests' => ['Верховая езда']
            ],
            [
                'phone' => '79370036123', 'email'=>'lianazai@mail.ru', 'password' => Hash::make("NxKjbxEW"), 'first_name' => 'Лиана', 'last_name' => 'Зайнутдинова',
                'photos' => ['https://drive.google.com/u/0/open?usp=forms_web&id=1FGSMxWEmfWhGCXGzNUmP_qSznibuEv0y', 'https://drive.google.com/u/0/open?usp=forms_web&id=1ayRdJ4BbuJDPizCu6WaPxXvdPg-BwGY2', 'https://drive.google.com/u/0/open?usp=forms_web&id=1CGHYwdcef2rclkBIqE7ygKsdugYqTll2', 'https://drive.google.com/u/0/open?usp=forms_web&id=1gbN17WVlFj_pip2vuNMcBs84SF7JlpVN'], 'gender' => 'female',
                'birth_date' => '28.02.1991', 'country' => 'Россия', 'city' => 'Казань', 'contact_phone_number' => '79370036123',  'habits'=>['alcohol'],
                'education_id' => 5, 'place_of_study' => 'Казанский федеральный университет', 'work_position' => 'Я проджект-менеджер онлайн-школы - помогаю продюсерам и экспертам запускать свои онлайн-продукты. Работаю удаленно более 1,5 года.',
                'place_of_work' => '', 'marital_status_id' => 1, 'have_children' => false, 'interests' => ['Чтение', 'Танцы', 'Прогулки', 'Путешествия', 'Изучение иностранных языков']
            ],
            ];
        foreach ($users as $user) {
            $account = User::create([
                'phone' => $user['phone'],
                'email'=>$user['email'],
                'password' => $user['password']
            ]);
            $profile = Profile::create([
                'user_id' => $account->id,
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'photos' => json_encode($user['photos']),
                'gender' => $user['gender'],
                'birth_date' => $user['birth_date'],
                'country' => $user['country'],
                'city' => $user['city'],
                'contact_phone_number' => $user['contact_phone_number'],
                'education_id' => $user['education_id'],
                'place_of_study' => $user['place_of_study'],
                'place_of_work' => $user['place_of_work'],
                'work_position' => $user['work_position'],
                'marital_status_id' => $user['marital_status_id'],
                'have_children' => $user['have_children']
            ]);
            if(isset($user['interests'])) {
                foreach ($user['interests'] as $interest) {
                    if (!Interest::where('title', $interest)->exists()) {
                        $int = Interest::create([
                            'title' => $interest
                        ]);
                    } else {
                        $int = Interest::where('title', $interest)->first();
                    }
                    $profile->interests()->save($int);
                }
            }
            if(isset($user['habits'])){
                foreach($user['habits'] as $habit){
                    $hab = Habit::where('title', $habit)->first();
                    $profile->habits()->save($hab);
                }
            }
        }

    }
}
