<?php // mui

// display_name = English

function e2l_load_strings () {

  return array (
  // engine
  'e2--vname-aegea' => 'Aegea',
  'e2--release' => 'release',
  'e2--powered-by' => 'Powered by',
  'e2--default-blog-title' => 'My blog',
  'e2--default-blog-author' => 'Blog author',
  
  // installer
  'pt--install' => 'Install Aegea',
  'gs--user-fixes-needed' => 'OK, something has to be fixed.',
  'gs--following-folders-missing' => 'The following folders are missing from the package:',
  'gs--could-not-create-them-automatically' => 'Could not create them automatically due to denied access. Please upload the whole package to the server.',
  'gs--and-reload-installer' => 'And reload the installer',
  'fb--begin' => 'Start blogging',
  'fb--retry' => 'Try again',
  'er--double-check-db-params' => 'Please double check database parameters',
  'gs--instantiated-version' => 'Instantiated version',
  'pt--installer-loading' => 'Loading...',
  'gs--database' => 'Database',
  'gs--password-for-blog' => 'Password to access the blog',
  'ff--just-connect' => 'I have data in my database, just connect to it',
  'ff--prefix-occupied' => 'already occupied',
  'ff--tables-not-found' => 'tables not found',

  // diags
  'et--fix-permissions-on-server' => 'Fix the permissions on server',
  'gs--enable-write-permissions-for-the-following' => 'Please enable write permissions here:',
  
  // sign in
  'pt--sign-in' => 'Sign in',
  'er--cannot-write-auth-data' => 'Cannot write authentication data',

  // archive
  'pt--nth-year' => 'The year $[year]',
  'pt--nth-month-of-nth-year' => '$[month.monthname] of the year $[year]',
  'pt--nth-day-of-nth-month-of-nth-year' => 'The $[day.ordinal] of $[month.monthname], $[year]',
  'gs--nth-month-of-nth-year' => '$[month.monthname] $[year]',
  'gs--nth-day-of-nth-month-of-nth-year' => '$[month.monthname.short] $[day], $[year]',
  'gs--everything' => 'All',
  'gs--part-x-of-y' => 'part $[part] of $[of]',
  
  // posts
  'ln--new-post' => 'New',
  'bt--close-comments-to-post' => 'Disallow comments to this post',
  'bt--open-comments-to-post' => 'Allow comments to this post',
  'pt--new-post' => 'New post',
  'pt--edit-post' => 'Edit post',
  'er--post-must-have-title-and-text' => 'A post must have a title and a text',
  'er--error-updating-post' => 'Error updating this post',
  'er--error-deleting-post-tag-info' => 'Error deleting this post’s tag information',
  'er--wrong-datetime-format' => 'Wrong date & time format. Must be “dd.mm.yyyy hh:mm:ss”',
  'er--cannot-get-post-from-db' => 'Couldn’t get the post from the database',
  'er--images-only-supported' => 'Only images are supported',
  'er--cannot-create-thumbnail' => 'Can’t create thumbnail',
  'er--cannot-upload' => 'Can’t upload file',
  'ff--title' => 'Title',
  'ff--text' => 'Text',
  'ff--text-formatting' => 'Formatting text',
  'ff--saving' => 'Saving',
  'ff--save' => 'Save',
  'ff--tags' => 'Tags',
  'ff--alias' => 'Alias',
  'ff--change-time' => 'Change time',
  'ff--delete' => 'Delete',
  'ff--will-get-address' => 'Will get address',
  'ff--is-at-address' => 'Published at address',

  'ff--gmt-offset' => 'GMT offset',
  'ff--with-dst' => '+1 in summer',
  'ff--post-time' => 'Post time',
  
  'pt--post-deletion' => 'Post deletion',
  'gs--post-will-be-deleted' => 'The post «$[post]» will be deleted with all comments.',

  // frontpage 
  'er--cannot-show-latest-notes' => 'Cannot show latest posts',
  'nm--posts' => 'Posts',
  'gs--next-posts' => 'next',
  'gs--prev-posts' => 'previous',
  
  // drafts
  'ln--drafts' => 'Drafts',
  'pt--drafts' => 'Drafts',
  'wd--draft' => 'draft',
  'pt--draft-deletion' => 'Draft deletion',
  'pt--edit-draft' => 'Edit draft',
  'gs--draft-will-be-deleted' => 'The draft «$[draft]» will be deleted.',
  
  // comments
  'pt--new-comment' => 'New comment',
  'pt--edit-comment' => 'Edit comment',
  'pt--reply-to-comment' => 'Reply to comment',
  'pt--edit-reply-to-comment' => 'Edit comment reply',
  'pt--unsubscription-done' => 'Done',
  'pt--unsubscription-failed' => 'Not done',
  'gs--you-are-no-longer-subscribed' => 'You are no longer subscribed to comments of post',
  'gs--you-are-not-subscribed' => 'Looks like you aren’t subscribed to this post’s comments',
  'gs--unsubscription-didnt-work' => 'Couldn’t unsubscribe you for unknown reason',
  'gs--comment-not-found' => 'Comment not found',
  'gs--post-not-found' => 'Post not found',
  'gs--comment-too-long' => 'Comment too long',
  'gs--comment-too-long-description' => 'You’ve submitted a very long comment, and it was not posted.',
  'gs--comment-double-post' => 'Double comment',
  'gs--comment-double-post-description' => 'You’ve submitted a comment more than once, only one was posted.',
  'gs--comment-spam-suspect' => 'Comment looks like spam',
  'gs--comment-spam-suspect-description' => 'Sorry, our robot has decided that this comment is spam, and it was not posted.',
  'gs--you-are-already-subscribed' => 'You are subscribed to comments. The link to unsubscribe is available in every mail with a new comment.',
  'er--post-not-commentable' => 'This post cannot be commented',
  'er--name-email-text-required' => 'Name, e-mail and comment text are all required',
  'ff--notify-subscribers' => 'Notify sender and other subscribers by email',
  'gs--your-comment' => 'Your comment',
  'ff--full-name' => 'Full name',
  'ff--email' => 'Email',
  'gs--email-wont-be-published' => 'won’t be published',
  'gs--no-html' => 'HTML will not work',
  'ff--subscribe-to-others-comments' => 'Get other comments by email',
  'gs--comment-restore' => 'Restore',
  'ff--text-of-your-comment' => 'Text of your comment',
  'gs--n-comments' => '$[number.cardinal]',
  'gs--no-comments' => 'no comments',
  'gs--comments-all-one-new' => 'new',
  'gs--comments-all-new' => 'new',
  'gs--comments-n-new' => '$[number.cardinal]',

  // tags
  'pt--tags' => 'Tags',
  'pt--posts-tagged' => 'Posts tagged',
  'tt--edit-tag' => 'Edit tag parameters and description',
  'gs--tagged' => 'tagged',
  'pt--tag-edit' => 'Edit tag',
  'pt--tag-delete' => 'Delete tag',
  'pt--posts-without-tags' => 'Posts without tags',
  'gs--no-posts-without-tags' => 'There are no posts without tags.',
  'er--bad-tag-urlname' => 'Chosen URL name cannot be used',
  'er--cannot-rename-tag' => 'This name or URL name are already in use by another tag',
  'ff--tag-name' => 'Display name',
  'ff--tag-urlname' => 'Name in URL',
  'ff--tag-description' => 'Description',
  'gs--tag-will-be-deleted-notes-remain' => 'The tag «$[tag]» will be deleted from posts, but the posts will remain.',
  'gs--see-also-tag' => 'See also:tags-impofd tag',
  'gs--tags-important' => 'important',
  'gs--tags-all' => 'all',
  'gs--tags' => 'Tags',
  
  // most commented and favourites
  'pt--most-commented' => 'Most commented $[period.periodname]',
  'nm--most-commented' => 'Hot',
  'pt--most-read' => 'Popular',
  'nm--most-read' => 'Popular',
  'pt--favourites' => 'Selected',
  'nm--favourites' => 'Selected',
  'gs--no-favourites' => 'There are no selected posts.',
  
  // generic posts pages
  'nm--pages' => 'Pages',
  'gs--next-page' => 'next',
  'gs--prev-page' => 'previous',
  'gs--earlier' => 'Earlier',
  'gs--later' => 'Later',
  'pt--n-posts' => '$[number.cardinal]',
  'pt--no-posts' => 'No posts',
  
  // search
  'pt--search' => 'Search',
  'pt--search-query-empty' => 'Search text is empty',
  'pt--search-query-too-short' => 'Search text is too short',
  'gs--found-for-query' => 'found for',
  'gs--search-query-empty' => 'Search text is empty, please enter something.',
  'gs--search-query-too-short' => 'Text too short, enter at least 4 characters.',
  'gs--nothing-found' => 'Nothing found.',
  'gs--many-posts' => 'Many posts',
  'pt--search-results' => 'Search results',
  
  // password, sessions, settings
  'pt--password' => 'Password',
  'pt--password-for-blog' => 'Password for the blog',
  'ff--old-password' => 'Old password',
  'ff--new-password' => 'New password',
  'fb--change' => 'Change',
  'gs--password-changed' => 'Password has been changed',
  'er--could-not-change-password' => 'Could not change password',
  'er--no-password-entered' => 'You have not entered a password',
  'er--wrong-password' => 'Wrong password',
  'ff--displayed-as-plain-text' => 'displayed in plain text',
  'er--settings-not-saved' => 'Settings not saved',
  
  'pt--sessions' => 'Open sessions',
  'gs--sessions-description' => 'When you sign in using your password on multiple devices or with multiple browsers, this page shows list of all these sessions. If any of them seems suspicious, end all sessions but this, then change your password.',
  'gs--sessions-browser-or-device' => 'Browser or device',
  'gs--sessions-when' => 'When',
  'gs--sessions-from-where' => 'From where',
  'gs--locally' => 'locally',
  'gs--unknown' => 'unknown',
  'fb--end-all-sessions-but-this' => 'End all sessions but this',
  'gs--ua-iphone' => 'iPhone',
  'gs--ua-ipad' => 'iPad',
  'gs--ua-opera' => 'Opera',
  'gs--ua-firefox' => 'Firefox',
  'gs--ua-chrome' => 'Chrome',
  'gs--ua-safari' => 'Safari',
  'gs--ua-unknown' => 'Unknown',
  'gs--ua-for-mac' => 'for Mac',

  'pt--settings' => 'Preferences',
  'ff--language' => 'Language',
  'ff--theme' => 'Theme',
  'ff--theme-how-to' => 'How to create a theme?',
  'ff--theme-selector-wants-js' => 'To select a theme please enable JavaScript.',
  'ff--posts' => 'Posts',
  'ff--items-per-page-before' => 'Display',
  'ff--items-per-page-after' => 'per page',
  'ff--show-sharing-buttons' => 'Show social sharing buttons',
  'ff--comments' => 'Comments',
  'ff--comments-enable' => 'Enable',
  'ff--only-for-recent-posts' => 'only for recent posts',
  'ff--show-hot' => 'show list of hot posts',
  'ff--send-to-address' => 'send by email to',
  'ff--administration' => 'Administration:',
  'gs--password' => 'password',
  'gs--db-connection' => 'database connection',
  
  'pt--name-and-author' => 'Name and author',
  'ff--blog-title' => 'Blog title',
  'ff--blog-description' => 'Short description',
  'ff--blog-author' => 'Author',

  'pt--database' => 'Database',
  'ff--db-host' => 'Host',
  'ff--db-username-and-password' => 'User and password',
  'ff--db-name' => 'Database name',
  'ff--db-prefix' => 'Table prefix',
  'fb--connect-to-this-db' => 'Connect using these parameters',
  'er--cannot-save-data' => 'Couldn’t save data',

  'pt--diagnostics' => 'Diagnostics',

  'ff--changing-sidebar' => 'How to change this column?',

  // welcome
  'pt--welcome' => 'Created!',
  'pt--welcome-text-pre' => 'Your blog has been created. ',
  'pt--welcome-text-href-write' => 'Write a post',
  'pt--welcome-text-or' => ' or ',
  'pt--welcome-text-href-settings' => 'set the things up',
  'pt--welcome-text-post' => '.',

  // need for password
  'gs--need-password' => 'Please enter your password',
  'ff--public-computer' => 'Public computer',
  'gs--need-password-for-action' => 'To $[action], please enter your password',
  'gs--np-action-write' => 'write a note',
  'gs--np-action-note-edit' => 'edit the note',
  'gs--np-action-comment-edit' => 'edit the comment',
  'gs--np-action-comment-reply' => 'reply to the comment',
  'gs--np-action-drafts' => 'open drafts',
  'gs--np-action-draft' => 'open the draft',
  'gs--np-action-tag-edit' => 'edit the tag',
  'gs--np-action-name-and-author' => 'change name',
  'gs--np-action-settings' => 'change settings',
  'gs--np-action-password' => 'change password',
  'gs--np-action-database' => 'change database data',
  'gs--np-action-sessions' => 'view session list',
  'gs--frontpage' => 'Home',
  
  // form buttons
  'fb--submit' => 'Submit',
  'fb--save-changes' => 'Save changes',
  'fb--save-and-preview' => 'Save and preview',
  'fb--publish' => 'Publish',
  'fb--publish-draft' => 'Publish the post',
  'fb--select' => 'Select',
  'fb--apply' => 'Apply',
  'fb--delete' => 'Delete',
  'fb--edit' => 'Edit',
  'fb--sign-in' => 'Sign in',
  'fb--sign-out' => 'Sign out',
  
  // mail
  'em--comment-new-to-author-subject' => '$[commenter] comments $[note-title]',
  'em--comment-new-to-public-subject' => '$[commenter] comments $[note-title]',
  'em--comment-reply-to-public-subject' => '$[blog-author] replies to comment',
  'em--comment-reply' => '$[note-title] ($[blog-author] replies)',
  'em--created-automatically' => 'This mail was created automatically',
  'em--unsubscribe' => 'Unsubscribe from this discussion',
  'em--reply' => 'Reply',
  'em--comment-replied-at' => 'Comment replied at',

  // rss
  'nf--comments-on-this-post' => 'Comments on this post',
  'gs--comments-on-post' => 'comments on the post' ,
  'gs--comment-on-post' => 'comment on the post' ,
  'gs--posts-tagged' => 'posts tagged',
  'gs--search-results' => 'search results',
  
  // social networks
  'sn--twitter-verb' => 'Tweet',
  'sn--facebook-verb' => 'Share',
  'sn--vkontakte-verb' => 'Share',
  'sn--pinterest-verb' => 'Pin',

  // time
  'pt--default-timezone' => 'Default timezone',
  'gs--e2-stores-each-posts-timezone' => 'Е2 stores timezone of each post separately.',
  'gs--e2-autodetects-timezone' => 'When publishing a post, the timezone will usually be detected automatically. In case of failure the timezone selected here will be used.',

  'tt--from-the-future' => 'From the future',
  'tt--just-published' => 'Just published',
  'tt--one-minute-ago' => 'A minute ago',
  'tt--minutes-ago' => '$[minutes.cardinal] ago',
  'tt--one-hour-ago' => 'An hour ago',
  'tt--hours-ago' => '$[hours.cardinal] ago',
  'tt--today-at' => 'Today at $[time]',
  'tt--date-and-time' => '$[month.monthname.short] $[day], $[time]',
  'tt--date-year-and-time' => '$[month.monthname.short] $[day], $[year], $[time]',

  'tt--zone-pt' => 'Pacific Time',
  'tt--zone-mt' => 'Mountain Time',
  'tt--zone-ct' => 'Central Time',
  'tt--zone-et' => 'East Coast Time',
  'tt--zone-gmt' => 'Greenwich Mean Time',
  'tt--zone-cet' => 'Central European Time',
  'tt--zone-eet' => 'East European Time',
  'tt--zone-msk' => 'Moscow Time',
  'tt--zone-ekt' => 'Chelyabinsk Time',
  'gs--timezone-offset-hours' => 'h',
  'gs--timezone-offset-minutes' => 'min',

  // umacros
  'um--month' => '$[month.monthname]',
  'um--month-short' => '$[month.monthname.short]',
  'um--month-g' => '$[month.monthname]',
  
  // more strings
  'gs--no-such-notes' => 'There are no such posts.',
  'pt--page-not-found' => 'Page not found',
  'gs--page-not-found' => 'Page not found.',
  
  'er--cannot-find-db' => 'Cannot find database',
  'er--cannot-connect-to-db' => 'Cannot connect to database',
  'er--error-in-query' => 'Error in query',
  'er--error-occurred' => 'Error occurred',
  'er--too-many-errors' => 'Too many errors',
  'gs--rss' => 'RSS',
  
  'gs--updated-successfully' => 'Updated successfully from version $[from] to version $[to]',
  'gs--pgt' => 'Generation time',
  'gs--seconds-contraction' => 's',
  'gs--good-blogs' => 'Good blogs and sites',

  );

}



function e2lstr_monthname ($number, $modifier = '') {
  if ($modifier == 'short') {
    $tmp = array (
      'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'
    );
  } else {
    $tmp = array (
      'December', 'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December', 'January'
    );
  }
  return $tmp[(int) $number];
}


function e2lstr_periodname ($period) {
  /**/if ('year' == $period) return 'over the year';
  elseif ('month' == $period) return 'over the month';
  elseif ('week' == $period) return 'over the week';
  elseif ('day' == $period) return 'over the day';
  else return 'ever';
}


function e2lstr_ordinal ($number) {
  if ($number % 10 == 1 and $number % 100 != 11) return $number. 'st';
  if ($number % 10 == 2 and $number % 100 != 12) return $number. 'nd';
  if ($number % 10 == 3 and $number % 100 != 13) return $number. 'rd';
  return $number. 'th';
}



function e2lstr_cardinal ($number, $modifier = '', $string_id) {
  $s = !($number % 10 == 1 and $number % 100 != 11);

  $result = $number;
  if ($string_id == 'pt--n-posts') $result = $number .' post'. ($s?'s':'');
  if ($string_id == 'tt--minutes-ago') $result = $number .' minute'. ($s?'s':'');
  if ($string_id == 'tt--hours-ago') $result = $number .' hour'. ($s?'s':'');
  if ($string_id == 'gs--n-comments') $result = $number .' comment'. ($s?'s':'');
  if ($string_id == 'gs--comments-n-new') $result = $number .' new';

  return $result;
  
}



?>