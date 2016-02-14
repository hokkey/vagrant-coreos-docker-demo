<?php
###############################
## ResourceSpace
## Local Configuration Script
###############################

# All custom settings should be entered in this file.
# Options may be copied from config.default.php and configured here.
$debug_log = false;
$config_show_performance_footer = false;
$debug_log_location = "/var/www/html/resourcespace/filestore/log.log";

# Set your time zone below (default GMT)
if (function_exists("date_default_timezone_set")) {date_default_timezone_set("Asia/Tokyo");}

# MySQL database settings
$mysql_server = 'mysql';
$mysql_username = getenv('MYSQL_USER_NAME');
$mysql_password = getenv('MYSQL_PASSWORD');
$mysql_db = getenv('MYSQL_DB');
$mysql_charset = 'utf8';

# Base URL of the installation
$baseurl = getenv('BASE_URL');

# proxy
$ip_forwarded_for = true;

# Email settings
$email_from = 'noreply@rs.com';
$email_notify = 'noreply@rs.com';

# SMTP
$use_smtp = getenv('USE_SMTP');
$use_phpmailer = getenv('USE_SMTP');
# '', 'tls' or 'ssl'. For Gmail, 'tls' or 'ssl' is required.
$smtp_sequre = getenv('SMTP_SECURE');
# Hostname, e.g. 'smtp.gmail.com'.
$smtp_host = getenv('SMTP_HOST');
# Port number, e.g. 465 for Gmail using SSL.
$smtp_port = getenv('SMTP_PORT');
# Send credentials to SMTP server (false to use anonymous access)
$smtp_auth = getenv('SMTP_AUTH');
# Username (full email address).
$smtp_username = getenv('SMTP_USERNAME');
# Password
$smtp_password = getenv('SMTP_PASSWORD');

# Paths
$pdftotext_path = '/usr/bin';
$exiftool_path = '/usr/bin';
$ghostscript_path = '/usr/bin';
$imagemagick_path = '/usr/bin';
$ffmpeg_path = '/usr/bin';
$storagedir = '/var/www/html/resourcespace/filestore';

# display field id on thumbnail view
$thumbs_display_fields = array(8, 3);

# display field id on list view
$list_display_fields = array(8, 3, 12);
$sort_fields = array(12);
$list_display_fields=array(8,51);
$list_search_results_title_trim=40;
$resource_type_column=false;

# imagemagick default colorspace
$imagemagick_colorspace= 'sRGB';

# create thumbnail on upload
$enable_thumbnail_creation_on_upload = true;

# collection download function
$collection_download = true;
$use_zip_extension=true; //use php-zip extension instead of $archiver or $zipcommand
$collection_download_settings[0]["name"] = 'ZIP';
$collection_download_settings[0]["extension"] = 'zip';
$collection_download_settings[0]["arguments"] = '-j';
$collection_download_settings[0]["mime"] = 'application/zip';

# ffmpeg setting
$ffmpeg_preview_max_width = 720;
$ffmpeg_preview_max_height = 480;
$ffmpeg_preview_options = "-f flv -ar 22050 -b 800k -ab 32k -ac 1";
$ffmpeg_supported_extensions = array(
  'aaf', '3gp', 'asf', 'avchd', 'avi', 'cam', 'dat', 'dsh', 'flv', 'm1v', 'm2v',
  'mkv', 'wrap', 'mov', 'mpeg', 'mpg', 'mpe', 'mp4', 'm4v', 'mxf', 'nsv', 'ogm',
  'ogv', 'rm', 'ram', 'svi', 'smi', 'webm', 'wmv', 'divx', 'xvid'
);

# show flv player in thumbs view
$video_player_thumbs_view=false;

# Option to always try and play the original file instead of preview - useful if recent change to $ffmpeg_preview_force doesn't suit e.g. if all users are
# on internal network and want to see HQ video
$video_preview_original=false;

# Create file checksums?
$file_checksums=true;

# How many results trigger the 'suggestion' feature, -1 disables the feature
# WARNING - there is a significant performance penalty for enabling this feature as it attempts to find the most popular keywords for the entire result set.
# It is not recommended for large systems.
$suggest_threshold=-1;

# Use Exiftool to attempt to extract specified resolution and unit information from files (ex. Adobe files) upon upload.
$exiftool_resolution_calc=true;

# Allow sorting by resource ID
$order_by_resource_id=true;

# Search on day in addition to month/year?
$searchbyday=true;

# Attempt to resolve a height and width of the ImageMagick file formats at view time
# (enabling may cause a slowdown on viewing resources when large files are used)
$imagemagick_calculate_sizes=true;

# When searching, also include themes/public collections at the top?
$search_includes_themes=false;

# Show an Empty Collection link which will empty the collection of resources (not delete them)
$emptycollection = true;

# Slim Header
#This uses an img tag to display the header and will automatically include a link to the homepage.
$slimheader = true;
# Custom source location for the header image (includes baseurl). Will default to the resourcespace logo if left blank. Recommended image size: 350px(X) x 80px(Y)
$linkedheaderimgsrc = "";

# Small slideshow mode (old slideshow)
$small_slideshow = false;

# Big slideshow mode (Fullscreen slideshow)
# ----------------------------------
# You will need to configure much bigger slideshow images with $home_slideshow_width and $home_slideshow_height, and regenerate
# your slideshow images using the transform plugin. This is recommended to be used along with the slim header.
$slideshow_big=false;
$home_slideshow_width=1400;
$home_slideshow_height=899;
# Number of seconds for slideshow to wait before changing image (must be greater than 1)
$slideshow_photo_delay = 5;

# In the collection frame, show or hide thumbnails by default? ("hide" is better if collections are not going to be heavily used).
$thumbs_default="hide";

# Show the contact us link?
$contact_link=false;

# Enable my collection link in head
$mycollections_link=true;

# turn on to create a clickable area over a logo graphic (to go to home page).
$header_link=true;

# Include ResourceSpace version header in View Source
$include_rs_header_info=true;

# Available languages
# If $defaultlanguage is not set, the brower's default language will be used instead
# $defaultlanguage="jp"; # default language, uses ISO 639-1 language codes ( en, es etc.)

# Disable language selection options (Includes Browser Detection for language)
$disable_languages=false;

# Show the language chooser on the bottom of each page
$show_language_chooser=false;

# Allow Browser Language Detection to also render the page in the browser specified language (If Detected).
$login_browser_language=true;

# If exiftool is installed, you can optionally enable the metadata report available on the View page.
# You may want to enable it on the usergroup level by overriding this config option in System Setup.
$metadata_report=true;

# Enable resource id search
$resourceid_simple_search=true;

# Enable random sort
$random_sort=true;

# Enable advanced search tile
$home_advancedsearch=true;

# infobox
$infobox=true;
$infobox_display_resource_icon=false;
$infobox_display_resource_id=true;
$infobox_fields=array(1,51,10);

# Enable user rating
$user_rating=true;
$display_user_rating_stars=true;

# Allow each user only one rating per resource (can be edited). Note this will remove all accumlated ratings/weighting on newly rated items.
$user_rating_only_once=true;

# Search for a minimum number of stars in Simple search/Advanaced Search (requires $$display_user_rating_stars)
$star_search=true;

# For checkbox list searching, perform logical AND instead of OR when ticking multiple boxes.
$checkbox_and=true;

# Option to show resource ID in the thumbnail, next to the action icons.
$display_resource_id_in_thumbnail=true;

# Enable jquery.zoom
$image_preview_zoom=true;

# Use checkboxes for selecting resources
$use_checkboxes_for_selection=true;

# Allow saving searches as 'smart collections' which self-update based on a saved search.
$allow_smart_collections=true;

# Iframe-based direct download from the view page (to avoid going to download.php)
# note this is incompatible with $terms_download and the $download_usage features, and is overridden by $save_as
$direct_download=false;
# add direct link to original file for each image size
$direct_link_previews = true;

# show the title of the resource being viewed in the browser title bar
$show_resource_title_in_titlebar=true;

# When displaying title of the resource, set the following to true if you want to show Upload resources or Edit resource when on edit page:
$distinguish_uploads_from_edits=true;

# pager dropdown
$pager_dropdown=true;

# Show/ hide "Remove resources" link from collection bar:
$remove_resources_link_on_collection_bar = true;

# Option to show dynamic dropdows as normal dropdowns on the simple search. If set to false, a standard text box is shown instead.
$simple_search_show_dynamic_as_dropdown=false;

# Omit archived resources from get_smart_themes (so if all resources are archived, the header won't show)
# Generally it's not possible to check for the existence of results based on permissions,
# but in the case of archived files, an extra join can help narrow the smart theme results to active resources.
$smart_themes_omit_archived=true;

# Allow Dates to be set within Date Ranges: Ensure to allow By Date to be used in Advanced Search if required.
$daterange_search=true;

# Show the resource view in a modal when accessed from search results.
$resource_view_modal=true;

# Allow users to request accounts?
$allow_account_request=false;

# Should the system allow users to request new passwords via the login screen?
$allow_password_reset=false;

$theme_images_align_right=true; # Align theme images to the right on the themes page? (particularly useful when there are multiple theme images)
$show_theme_collection_stats=true; # Show count of themes and resources in theme category