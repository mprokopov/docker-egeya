<?php 

// display_name = Русский

function e2l_load_strings () {

  return array (
  // engine
  'e2--vname-aegea' => 'Эгея',
  'e2--release' => 'релиз',
  'e2--powered-by' => 'Движок —',
  'e2--default-blog-title' => 'Мой блог',
  'e2--default-blog-author' => 'Автор блога',
  
  // installer
  'pt--install' => 'Установка Эгеи',
  'gs--user-fixes-needed' => 'Так, нужно кое-что поправить.',
  'gs--following-folders-missing' => 'Не найдены следующие папки из дистрибутива движка:',
  'gs--could-not-create-them-automatically' => 'Создать их автоматически не удалось из-за недостатка прав. Загрузите на сервер полный дистрибутив.',
  'gs--and-reload-installer' => 'И перезагрузите установщик',
  'fb--begin' => 'Начать блог',
  'fb--retry' => 'Попробовать ещё раз',
  'er--double-check-db-params' => 'Перепроверьте реквизиты базы',
  'gs--instantiated-version' => 'Инстанциирована версия',
  'pt--installer-loading' => 'Загрузка...',
  'gs--database' => 'База данных',
  'gs--password-for-blog' => 'Пароль для доступа к блогу',
  'ff--just-connect' => 'Данные в моей базе уже есть, нужно просто подключиться к ней',
  'ff--prefix-occupied' => 'уже занят',
  'ff--tables-not-found' => 'таблиц не найдено',

  // diags
  'et--fix-permissions-on-server' => 'Настройте права на сервере',
  'gs--enable-write-permissions-for-the-following' => 'Пожалуйста, дайте права на запись здесь:',
  
  // sign in
  'pt--sign-in' => 'Вход',
  'er--cannot-write-auth-data' => 'Не удаётся записать данные аутентификации',

  // archive
  'pt--nth-year' => '$[year]-й год',
  'pt--nth-month-of-nth-year' => '$[month.monthname] $[year] года',
  'pt--nth-day-of-nth-month-of-nth-year' => '$[day] $[month.monthname.genitive] $[year]-го',
  'gs--nth-month-of-nth-year' => '$[month.monthname] $[year]',
  'gs--nth-day-of-nth-month-of-nth-year' => '$[day] $[month.monthname.genitive] $[year]',
  'gs--everything' => 'Всё',
  'gs--part-x-of-y' => 'часть $[part] из $[of]',
  
  // posts
  'ln--new-post' => 'Новая',
  'bt--close-comments-to-post' => 'Закрыть комментарии к заметке',
  'bt--open-comments-to-post' => 'Открыть комментарии к заметке',
  'pt--new-post' => 'Новая заметка',
  'pt--edit-post' => 'Правка заметки',
  'er--post-must-have-title-and-text' => 'У заметки должны быть название и текст',
  'er--error-updating-post' => 'Ошибка при изменении заметки',
  'er--error-deleting-post-tag-info' => 'Ошибка при удалении данных о тегах заметки',
  'er--wrong-datetime-format' => 'Неправильный формат даты-времени. Должен быть: «ДД.ММ.ГГГГ ЧЧ:ММ:СС»',
  'er--cannot-get-post-from-db' => 'Не удалось извлечь заметку из базы',
  'er--images-only-supported' => 'Поддерживаются только изображения',
  'er--cannot-create-thumbnail' => 'Не удалось создать уменьшенное изображение',
  'er--cannot-upload' => 'Не удалось загрузить файл',
  'ff--title' => 'Название',
  'ff--text' => 'Текст',
  'ff--text-formatting' => 'Форматирование текста',
  'ff--saving' => 'Сохранение...',
  'ff--save' => 'Сохранить',
  'ff--tags' => 'Теги',
  'ff--alias' => 'Ссылка',
  'ff--change-time' => 'Изменить время',
  'ff--delete' => 'Удалить',
  'ff--will-get-address' => 'Получит адрес',
  'ff--is-at-address' => 'Опубликована по адресу',

  'ff--gmt-offset' => 'Разница с Гринвичем',
  'ff--with-dst' => '+1 летом',
  'ff--post-time' => 'Время публикации',
  
  'pt--post-deletion' => 'Удаление заметки',
  'gs--post-will-be-deleted' => 'Заметка «$[post]» будет удалена вместе со всеми комментариями.',

  // frontpage 
  'er--cannot-show-latest-notes' => 'Невозможно отобразить последние заметки',
  'nm--posts' => 'Заметки',
  'gs--next-posts' => 'следующие',
  'gs--prev-posts' => 'предыдущие',
  
  // drafts
  'ln--drafts' => 'Черновики',
  'pt--drafts' => 'Черновики',
  'wd--draft' => 'черновик',
  'pt--draft-deletion' => 'Удаление черновика',
  'pt--edit-draft' => 'Правка черновика',
  'gs--draft-will-be-deleted' => 'Черновик «$[draft]» будет удалён.',
  
  // comments
  'pt--new-comment' => 'Новый комментарий',
  'pt--edit-comment' => 'Правка комментария',
  'pt--reply-to-comment' => 'Ответ на комментарий',
  'pt--edit-reply-to-comment' => 'Правка ответа на комментарий',
  'pt--unsubscription-done' => 'Получилось!',
  'pt--unsubscription-failed' => 'Не получилось',
  'gs--you-are-not-subscribed' => 'Кажется, вы и так не подписаны на комментарии к этой заметке',
  'gs--you-are-no-longer-subscribed' => 'Вы больше не подписаны на комментарии к заметке',
  'gs--unsubscription-didnt-work' => 'Почему-то отписка не сработала',          
  'gs--comment-not-found' => 'Комментарий не найден',
  'gs--post-not-found' => 'Заметка не найдена',
  'gs--comment-too-long' => 'Слишком длинный комментарий',
  'gs--comment-too-long-description' => 'Вы отправили слишком длинный комментарий, поэтому он не был сохранён.',
  'gs--comment-double-post' => 'Повторный комментарий',
  'gs--comment-double-post-description' => 'Вы отправили комментарий дважды, сохранён был только один.',
  'gs--comment-spam-suspect' => 'Комментарий похож на спам',
  'gs--comment-spam-suspect-description' => 'Простите, но робот решил, что это спам, поэтому комментарий не был отправлен.',
  'gs--you-are-already-subscribed' => 'Вы подписаны на комментарии. Ссылка для отписки приходит в каждом письме с новым комментарием.',
  'er--post-not-commentable' => 'Эту заметку нельзя комментировать',
  'er--name-email-text-required' => 'И имя, и эл. адрес, и текст комментария обязательны',
  'ff--notify-subscribers' => 'Отправить по почте комментатору и другим подписчикам',
  'gs--your-comment' => 'Ваш комментарий',
  'ff--full-name' => 'Имя и фамилия',
  'ff--email' => 'Эл. почта',
  'gs--email-wont-be-published' => 'адрес не будет опубликован',
  'gs--no-html' => 'ХТМЛ не работает',
  'ff--subscribe-to-others-comments' => 'Получать комментарии других по почте',
  'gs--comment-restore' => 'Вернуть',
  'ff--text-of-your-comment' => 'Текст вашего комментария',
  'gs--n-comments' => '$[number.cardinal]',
  'gs--no-comments' => 'нет комментариев',
  'gs--comments-all-one-new' => 'новый',
  'gs--comments-all-new' => 'новые',
  'gs--comments-n-new' => '$[number.cardinal]',
  
  // tags
  'pt--tags' => 'Теги',
  'pt--posts-tagged' => 'Заметки с тегом',
  'tt--edit-tag' => 'Править параметры и описание тега',
  'gs--tagged' => 'с тегом',
  'pt--tag-edit' => 'Изменение тега',
  'pt--tag-delete' => 'Удаление тега',
  'pt--posts-without-tags' => 'Заметки без тегов',
  'gs--no-posts-without-tags' => 'Заметок без тегов нет.',
  'er--bad-tag-urlname' => 'Такой вид в адресной строке не может быть использован',
  'er--cannot-rename-tag' => 'Такое имя или вид в адресной строке уже используются другим тегом',
  'ff--tag-name' => 'Название',
  'ff--tag-urlname' => 'В адресной строке',
  'ff--tag-description' => 'Описание',
  'gs--tag-will-be-deleted-notes-remain' => 'Тег «$[tag]» будет удалён из заметок, но сами заметки останутся.',
  'gs--see-also-tag' => 'См. также тег',
  'gs--tags-important' => 'важные',
  'gs--tags-all' => 'все',
  'gs--tags' => 'Теги',
  
  // most commented and favourites
  'pt--most-commented' => 'Самые комментируемые за $[period.periodname]',
  'nm--most-commented' => 'Обсуждаемое',
  'pt--most-read' => 'Самые читаемые за $[period.periodname]',
  'nm--most-read' => 'Популярное',
  'pt--favourites' => 'Избранное',
  'nm--favourites' => 'Избранное',
  'gs--no-favourites' => 'Избранного нет.',
  
  // generic posts pages
  'nm--pages' => 'Страницы',
  'gs--next-page' => 'следующая',
  'gs--prev-page' => 'предыдущая',
  'gs--earlier' => 'Ранее',
  'gs--later' => 'Позднее',
  'pt--n-posts' => '$[number.cardinal]',
  'pt--no-posts' => 'Нет заметок',

  // search
  'pt--search' => 'Поиск',
  'pt--search-query-empty' => 'Текст для поиска пуст',
  'pt--search-query-too-short' => 'Слишком короткий текст',
  'gs--found-for-query' => 'по запросу',
  'gs--search-query-empty' => 'Текст для поиска пуст, напишите что-нибудь',
  'gs--search-query-too-short' => 'Слишком короткий текст, напишите хотя бы 4 буквы.',
  'gs--nothing-found' => 'Ничего не найдено.',
  'gs--many-posts' => 'Много заметок',
  'pt--search-results' => 'Результаты поиска',
  
  // password, sessions, settings
  'pt--password' => 'Пароль',
  'pt--password-for-blog' => 'Пароль для доступа к блогу',
  'ff--old-password' => 'Старый пароль',
  'ff--new-password' => 'Новый пароль',
  'fb--change' => 'Поменять',
  'gs--password-changed' => 'Пароль изменён',
  'er--could-not-change-password' => 'Не получилось изменить пароль',
  'er--no-password-entered' => 'Вы не ввели пароль',
  'er--wrong-password' => 'Неправильный пароль',
  'ff--displayed-as-plain-text' => 'отображается при вводе',
  'er--settings-not-saved' => 'Настройка не сохранена',

  'pt--sessions' => 'Открытые сессии',
  'gs--sessions-description' => 'Когда вы заходите под своим паролем на нескольких устройствах или с помощью нескольких браузеров, здесь показывается список всех таких сессий. Если какая-то из них вызывает подозрения, завершите все сессии кроме текущей, а потом смените пароль от блога.',
  'gs--sessions-browser-or-device' => 'Браузер или устройство',
  'gs--sessions-when' => 'Когда',
  'gs--sessions-from-where' => 'Откуда',
  'gs--locally' => 'локально',
  'gs--unknown' => 'неизвестен',
  'fb--end-all-sessions-but-this' => 'Завершить все сессии кроме текущей',
  'gs--ua-iphone' => 'Айфон',
  'gs--ua-ipad' => 'Айпад',
  'gs--ua-opera' => 'Опера',
  'gs--ua-firefox' => 'Фаерфокс',
  'gs--ua-chrome' => 'Хром',
  'gs--ua-safari' => 'Сафари',
  'gs--ua-unknown' => 'Неизв.',
  'gs--ua-for-mac' => 'на Маке',

  'pt--settings' => 'Настройка',
  'ff--language' => 'Язык',
  'ff--theme' => 'Оформление',
  'ff--theme-how-to' => 'Как создать свою тему?',
  'ff--theme-selector-wants-js' => 'Для выбора темы оформления, включите в браузере поддержку скриптов (JavaScript).',
  'ff--posts' => 'Заметки',
  'ff--items-per-page-before' => 'Показывать по',
  'ff--items-per-page-after' => 'на странице',
  'ff--show-sharing-buttons' => 'Показывать кнопки отправки в соцсети',
  'ff--comments' => 'Комментарии',
  'ff--comments-enable' => 'Разрешать',
  'ff--only-for-recent-posts' => 'только к свежим заметкам',
  'ff--show-hot' => 'показывать блок «Обсуждаемое»',
  'ff--send-to-address' => 'присылать по почте на адрес:',
  'ff--administration' => 'Администрирование:',
  'gs--password' => 'пароль',
  'gs--db-connection' => 'соединение с базой',

  'pt--name-and-author' => 'Название и автор',
  'ff--blog-title' => 'Название блога',
  'ff--blog-description' => 'Коротко о блоге',
  'ff--blog-author' => 'Автор',

  'pt--database' => 'База данных',
  'ff--db-host' => 'Сервер',
  'ff--db-username-and-password' => 'Имя пользователя и пароль',
  'ff--db-name' => 'Название базы',
  'ff--db-prefix' => 'Префикс таблиц',
  'fb--connect-to-this-db' => 'Подключиться с этими параметрами',
  'er--cannot-save-data' => 'Не получается сохранить данные',
  
  'pt--diagnostics' => 'Диагностика',

  'ff--changing-sidebar' => 'Как изменить эту колонку?',
  
  // welcome
  'pt--welcome' => 'Готово!',
  'pt--welcome-text-pre' => 'Блог создан. ',
  'pt--welcome-text-href-write' => 'Напишите заметку',
  'pt--welcome-text-or' => ' или ',
  'pt--welcome-text-href-settings' => 'настройте что-нибудь',
  'pt--welcome-text-post' => '.',

  // need for password
  'gs--need-password' => 'Зайдите под своим паролем',
  'ff--public-computer' => 'Чужой компьютер',
  'gs--need-password-for-action' => 'Чтобы $[action], зайдите под своим паролем',
  'gs--np-action-write' => 'написать заметку',
  'gs--np-action-note-edit' => 'править заметку',
  'gs--np-action-comment-edit' => 'править этот комментарий',
  'gs--np-action-comment-reply' => 'ответить на этот комментарий',
  'gs--np-action-drafts' => 'открыть черновики',
  'gs--np-action-draft' => 'открыть этот черновик',
  'gs--np-action-tag-edit' => 'править этот тег',
  'gs--np-action-name-and-author' => 'изменять название блога',
  'gs--np-action-settings' => 'настраивать блог',
  'gs--np-action-password' => 'изменять пароль',
  'gs--np-action-database' => 'изменять параметры базы данных',
  'gs--np-action-sessions' => 'просматривать сессии',
  'gs--frontpage' => 'Главная страница',
  
  // form buttons
  'fb--submit' => 'Отправить',
  'fb--save-changes' => 'Сохранить изменения',
  'fb--save-and-preview' => 'Сохранить и посмотреть',
  'fb--publish' => 'Опубликовать',
  'fb--publish-draft' => 'Опубликовать заметку',
  'fb--select' => 'Выбрать',
  'fb--apply' => 'Применить',
  'fb--delete' => 'Удалить',
  'fb--edit' => 'Править',
  'fb--sign-in' => 'Войти',
  'fb--sign-out' => 'Выйти',
  
  // time
  'pt--default-timezone' => 'Часовой пояс по умолчанию',
  'gs--e2-stores-each-posts-timezone' => 'Е2 хранит часовой пояс отдельно для каждой заметки.',
  'gs--e2-autodetects-timezone' => 'При публикации часовой пояс обычно определяется автоматически. А в случае неудачи используется выбранный здесь часовой пояс.',

  'tt--from-the-future' => 'Из будущего',
  'tt--just-published' => 'Только что',
  'tt--one-minute-ago' => 'Минуту назад',
  'tt--minutes-ago' => '$[minutes.cardinal] назад',
  'tt--one-hour-ago' => 'Час назад',
  'tt--hours-ago' => '$[hours.cardinal] назад',
  'tt--today-at' => 'Сегодня в $[time]',
  'tt--date-and-time' => '$[day] $[month.monthname.genitive], $[time]',
  'tt--date-year-and-time' => '$[day] $[month.monthname.genitive] $[year], $[time]',

  'tt--zone-pt' => 'Тихоокеанское время',
  'tt--zone-mt' => 'Горное время',
  'tt--zone-ct' => 'Центральное время',
  'tt--zone-et' => 'Восточное время',
  'tt--zone-gmt' => 'Время по Гринвичу',
  'tt--zone-cet' => 'Центрально-европейское время',
  'tt--zone-eet' => 'Восточно-европейское время',
  'tt--zone-msk' => 'Московское время',
  'tt--zone-ekt' => 'Челябинское время',
  'gs--timezone-offset-hours' => 'ч',
  'gs--timezone-offset-minutes' => 'мин',
  
  // mail
  'em--comment-new-to-author-subject' => '$[commenter] комментирует $[note-title]',
  'em--comment-new-to-public-subject' => '$[commenter] комментирует $[note-title]',
  'em--comment-reply-to-public-subject' => '$[blog-author] отвечает на комментарий',
  'em--comment-reply' => '$[note-title] ($[blog-author] ответил)',
  'em--created-automatically' => 'Письмо создано автоматически.',
  'em--unsubscribe' => 'Отписаться от этого обсуждения',
  'em--reply' => 'Ответить',
  'em--comment-replied-at' => 'Комментарий, на который ответил автор',
  
  // rss
  'nf--comments-on-this-post' => 'Комментарии к этой заметке',
  'gs--comments-on-post' => 'комментарии к заметке',
  'gs--comment-on-post' => 'комментарий к заметке',
  'gs--posts-tagged' => 'заметки с тегом',
  'gs--search-results' => 'результаты поиска',
  
  // social networks
  'sn--twitter-verb' => 'Твитнуть',
  'sn--facebook-verb' => 'Поделиться',
  'sn--vkontakte-verb' => 'Поделиться',
  'sn--pinterest-verb' => 'Запинить',

  // umacros
  'um--month' => '$[month.monthname]',
  'um--month-short' => '$[month.monthname.short]',
  'um--month-g' => '$[month.monthname.genitive]',
  
  // more strings
  'gs--no-such-notes' => 'Таких заметок нет.',
  'pt--page-not-found' => 'Страница не найдена',
  'gs--page-not-found' => 'Страница не найдена.',
  
  'er--cannot-find-db' => 'Не могу найти базу данных',
  'er--cannot-connect-to-db' => 'Не могу соединиться с базой данных',
  'er--error-in-query' => 'Ошибка при запросе',
  'er--error-occurred' => 'Произошла ошибка',
  'er--too-many-errors' => 'Слишком много ошибок',
  'gs--rss' => 'РСС',
  
  'gs--pgt' => 'Время генерации',
  'gs--seconds-contraction' => 'с',
  'gs--updated-successfully' => 'Выполнено обновление с версии $[from] до версии $[to]',
  'gs--good-blogs' => 'Хорошие блоги и сайты',
  
  );
  
}



function e2lstr_monthname ($number, $modifier = '') {
  if ($modifier == 'genitive') {
    $tmp = array (
      'декабря', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
      'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря', 'января'
    );
  } elseif ($modifier == 'short') {
    $tmp = array (
      'дек', 'янв', 'фев', 'март', 'апр', 'май', 'июнь',
      'июль', 'авг', 'сен', 'окт', 'ноя', 'дек', 'янв'
    );
  } else {
    $tmp = array (
      'Декабрь', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
      'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь', 'Январь'
    );
  }
  return $tmp[(int) $number];
}


function e2lstr_periodname ($period) {
  /**/if ('year' == $period) return 'год';
  elseif ('month' == $period) return 'месяц';
  elseif ('week' == $period) return 'неделю';
  elseif ('day' == $period) return 'день';
  else return 'всю историю';
}


function e2lstr_cardinal ($number, $modifier = '', $string_id) {

  $what = $number;
  if ($string_id == 'pt--n-posts') $what = $number .' замет(ка,ки,ок)';
  if ($string_id == 'tt--minutes-ago') $what = $number .' минут(у,ы,)';
  if ($string_id == 'tt--hours-ago') $what = $number .' час(а,ов)';
  if ($string_id == 'gs--n-comments') $what = $number .' комментари(й,я,ев)';
  if ($string_id == 'gs--comments-n-new') $what = $number .' новы(й,х,х)';

  return e2_decline_for_number ($what);
  
}



?>