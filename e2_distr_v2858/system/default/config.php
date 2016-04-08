<?php 


// after changing some of these params it may be necessary
// to drop the cache
// for that, go to your-website-address/?go=@sync


// UI

// years range separator for the copyright line
$_config['years_range_separator'] = '&mdash;'; /* html */

// period for the most commented (hot) posts
$_config['hot_period'] = 'month'; /* 'day', 'week', 'month', 'year', 'ever' */

// period for the most read (popular) posts
$_config['popular_period'] = 'month'; /* 'day', 'week', 'month', 'year', 'ever' */

// default text formatter (make sure you know why you change it)
$_config['default_formatter'] = 'neasden'; /* 'raw', 'calliope', 'neasden' */

// when publishing a post, enable comments for it by default
$_config['publish_with_comments_on'] = true;


// THEMES

// show raw template data instead of using actual templates
$_config['raw_template_data'] = false;
  
// show raw template date with ?raw parameter
$_config['raw_template_data_with_param'] = false;

// show system theme in settings
$_config['list_system_theme'] = false;

// when a template file is missing, treat it as if it were empty
$_config['ignore_missing_template_files'] = true; /* bool */

// default maximum image width
$_config['max_image_width'] = 768; /* pixels */



// URLS

// redirect to canonical urls when synonims are used
$_config['force_canonical_urls'] = true;
  
// redirect to this domain name (will work only if force_canonical_urls is on)
$_config['preferred_domain_name'] = null; /* null or string */
  
// use beautiful (synthetic) or ?parametrised (real) urls
$_config['url_composition'] = 'auto'; /* 'auto', 'real', 'synthetic' */

// too hard to explain
$_config['note_url_slidedown'] = true;
  


// MISC

// sender address for outgoing mail (if ends with @, domain name will be added)
$_config['mail_from'] = 'blog@';
  
// use 'index, follow' everywhere (otherwise will be only where necessary)
$_config['index_follow_everything'] = true;
  
// access rights to use for uploaded files
$_config['uploaded_files_mode'] = 0777;

// whois service (URL to append IP address to)
$_config['whois_service'] = 'https://www.nic.ru/whois/?ip=';



// SOCIAL NETWORKS

// which networks to share to
$_config['share_to'] = 'twitter, facebook, vkontakte, pinterest';

// via whom to share to Twitter
$_config['share_to_twitter_via'] = '';



// CONSTANTS

// maximum length of a comment in bytes (bigger ones won't be accepted)
$_config['max_comment_length'] = 4096;

// for how many days are comments fresh?
$_config['comment_freshness_days'] = 14;

// number of items in RSS feeds
$_config['rss_items'] = 10;



// DEBUG

// write a log to user/log.txt? (it will get very large soon)
$_config['write_log'] = false;

// reset a log sometimes
$_config['write_log_reset'] = false;

// show call stack when displaying error?
$_config['show_call_stack'] = 0; /* 0 - no; 1 - when logged in; 2 - always */

// store backtrace in backtrace.psa?
$_config['store_backtrace'] = false;
  
// make ajax slower?
$_config['debug_slow_ajax'] = false;
  
// write HTTP request log?
$_config['request_logging'] = false;

  

?>