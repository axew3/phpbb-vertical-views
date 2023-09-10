<?php
/**
 *
 * Vertical Views. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2023, axew3, http://axew3.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace w3all\w3vv\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Vertical Views Event listener.
 */
class main_listener implements EventSubscriberInterface
{
  public static function getSubscribedEvents()
  {
    return array(
      'core.user_setup' => 'load_language_on_setup',
     // 'core.page_head' => 'overall_header_head_append',

     'core.viewtopic_get_post_data' => 'viewtopic_get_post_data',
     'core.viewtopic_modify_post_data' => 'viewtopic_modify_post_data',
     'core.viewtopic_post_row_after' => 'viewtopic_post_row_after',
     'core.display_forums_modify_template_vars' => 'display_forums_modify_template_vars',
     'core.viewforum_modify_topics_data' => 'viewforum_modify_topics_data',
     'core.page_footer' => 'overall_footer_body_after',
    );
  }

  protected $language;
  protected $config;
  protected $template;
  protected $request;
  protected $php_ext;


  public function __construct(\phpbb\language\language $language, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\request\request_interface $request, $php_ext)
  {
    $this->language = $language;
    $this->config   = $config;
    $this->template = $template;
    $this->request  = $request;
    $this->php_ext  = $php_ext;
  }

  /**
   * Load common language files during user setup
   *
   * @param \phpbb\event\data $event  Event object
   */
  public function load_language_on_setup($e)
  {

    //  a (asc) by default
    $epd = empty($e['user_data']['user_post_sortby_dir']) ? 'a' : $e['user_data']['user_post_sortby_dir'];
    $etd = empty($e['user_data']['user_topic_sortby_dir']) ? 'a' : $e['user_data']['user_topic_sortby_dir'];

    define('W3VV_DIRPOST_SORT', $epd);
    define('W3VV_DIRTOPIC_SORT', $etd);
  }


    public function viewtopic_get_post_data($e)
  {
   // echo'viewtopic_get_post_data <pre>'; print_R($e);exit;
  }

# viewtopic

    public function viewtopic_modify_post_data($e)
  {

    if( empty($e['topic_data']) OR empty($e['rowset']) ) return;

     //global $auth;
     // Get user's permissions (so to know what we have to pass, as total posts count num (so if include or not the soft deleted and to be moderated in the total count)
     // $user_can_moderate_forum = $auth->acl_get('m_', $e['forum_id']);

      $w3lt = $this->request->variable('w3vvVTLoadTopic', 0);

/*
      $plist_postid_start = $e['post_list'][array_key_first($e['post_list'])];
      $plist_postid_end = $e['post_list'][array_key_last($e['post_list'])];

      $rev_plist_postid_start = $plist_postid_end;
      $rev_plist_postid_end = $plist_postid_start;

      $p_approved_num = $e['topic_data']['topic_posts_approved'];
      $p_total_num = $e['topic_data']['topic_posts_approved'] + $e['topic_data']['topic_posts_unapproved'] + $e['topic_data']['topic_posts_softdeleted'];

      // try to know how many pages we have to retrieve (users or admin/mod)
      // $total_pages = ceil($num_items / $per_page); // see /phpbb/pagination.php
      $admTotPages = round($p_total_num / count($e['post_list']));
      $usrTotPages = round($p_approved_num / count($e['post_list']));
*/
      //[topic_posts_approved] => 32
      //[topic_posts_unapproved] => 1
      //[topic_posts_softdeleted] => 2

      $this->template->assign_vars(array(
/*     'W3VVFIRST_ONTOPIC' => $e['topic_data']['topic_first_post_id'],
       'W3VVLAST_ONTOPIC' => $e['topic_data']['forum_last_post_id'],
       'W3VVPHPBBEXT' => $this->php_ext,
       //'W3VVPP' => $post_placeholder,
       'W3VVPP_VT_POSTS_X_PAGE' => count($e['post_list']),
       'W3VVPP_VT_PLIST_PID_ARYFIRST' => $plist_postid_start,
       'W3VVPP_VT_PLIST_PID_ARYLAST' => $plist_postid_end,
       'W3VVPP_VT_REV_PLIST_PID_ARYFIRST' => $rev_plist_postid_start,
       'W3VVPP_VT_REV_PLIST_PID_ARYLAST' => $rev_plist_postid_end,
       'W3VV_DIRTOPIC_SORT' => W3VV_DIRTOPIC_SORT,
       'W3VV_DIRPOST_SORT' => W3VV_DIRPOST_SORT,
       'W3VV_PAPPROVED_NUM' => $p_approved_num,
       'W3VV_PTOTAL_NUM' => $p_total_num,
       'W3VV_ADM_TOTPAGES_NUM' => $admTotPages,
       'W3VV_USR_TOTPAGES_NUM' => $usrTotPages,*/
       'W3VV_ONVIEWTOPIC' => 1,
       'W3VV_VIEWTOPIC_MODE' => $w3lt,));


   }


    public function viewtopic_post_row_after($e)
  {

    //echo'viewtopic_post_row_after <pre>'; print_R($e);exit;
  }


# viewforum

    public function display_forums_modify_template_vars($e)
  {

    #echo'display_forums_modify_template_vars <pre>'; print_R($e);exit;
  }


    public function viewforum_modify_topics_data($e)
  {
   // echo'viewforum_modify_topics_data <pre>'; print_R($e);exit;

  }


    public function overall_footer_body_after()
  {


  }


}


