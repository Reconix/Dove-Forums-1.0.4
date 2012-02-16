<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  Forums Language - English
* 
* Author: Chris Baines
* 		  chris@doveforums.com
* 
* Location: http://www.doveforums.com
* 
* Description:  English language file for all Forums & Related Modules
* 
*/

// Global
$lang['noCategory'] = 'All Discussions';
$lang['createdText'] = 'Created ';
$lang['lastPostText'] = 'Last Post ';
$lang['profileText'] = '`s profile';
$lang['byText'] = 'By';
$lang['agoText'] = 'ago';
$lang['saysText'] = 'say`s';

// Page Titles
$lang['titleHome'] = 'Home';
$lang['titleTopics'] = 'Discussions';
$lang['titleCreateNewDiscussion'] = 'Start a New Discussion';
$lang['titleSettings'] = 'Settings';
$lang['titleChangePassword'] = 'Change Password';
$lang['titleProfile'] = 'Profile';
$lang['titleForgotPassword'] = 'Forgot Password';
$lang['titleEditPost'] = 'Edit Post';
$lang['titleSearchResults'] = 'Search Results';

// Location: modules/forums/controllers/forums.php
$lang['addNewDiscussion'] = 'Start a New Discussion';
$lang['topicHeading'] = 'Topic';
$lang['postsHeading'] = 'Posts';
$lang['lastReplyHeading'] = 'Last Reply';
$lang['avatarTitle'] = '`s avatar';
$lang['avatarAltText'] = 'avatar';
$lang['downArrowTitle'] = 'Show last 5 Posts';
$lang['downArrowAltText'] = 'Dropdown Arrow';
$lang['upArrowTitle'] = 'Close last 5 Posts';
$lang['upArrowAltText'] = 'Close Dropwdown Arrow';
$lang['contentArrowAltText'] = 'Content Arrow';
$lang['noDiscussions'] = 'There is currently no discussions, Login or Register to create one!';
$lang['discussionsSticky'] = '&#91;Sticky&#93;';
$lang['discussionsClosed'] = '&#91;Closed&#93;';
$lang['discussionsReadMore'] =  ' Continue reading this post &gt;&gt;';
$lang['discussionsAscending'] = 'Ascending';
$lang['discussionsDescending'] = 'Descending';
$lang['discussionsSortAscending'] = 'Sort Discussions Ascending';
$lang['discussionsSortDescending'] = 'Sort Discussions Descending';
$lang['discussionsEditTitle'] = 'Edit Discussion';
$lang['discussionsDeleteTitle'] = 'Delete Discussion';

// Location: modules/forums/views/register.php
$lang['registerHeader'] = 'Register';
$lang['registerSection1'] = 'Your Details';
$lang['registerFirstName'] = 'First Name:';
$lang['registerFirstNameTitle'] = 'Enter your First Name';
$lang['registerLastName'] = 'Last Name:';
$lang['registerLastNameTitle'] = 'Enter your Last Name';
$lang['registerSection2'] = 'Login Details';
$lang['registerUsername'] = 'Username:';
$lang['registerUsernameTitle'] = 'Enter desired username';
$lang['registerPassword'] = 'Password:';
$lang['registerPasswordTitle'] = 'Enter desired password';
$lang['registerConfirmPassword'] = 'Confirm Password:';
$lang['registerConfirmPasswordTitle'] = 'Re-enter desired password';
$lang['registerEmail'] = 'Email:';
$lang['registerEmailTitle'] = 'Enter valid email';
$lang['registerConfirmEmail'] = 'Confirm Email:';
$lang['registerConfirmEmailTitle'] = 'Re-enter valid email';
$lang['registerButton'] = 'Register';

// Location: modules/forums/views/settings.php
$lang['settingsHeader'] = 'Change Settings';
$lang['settingsProfileFirstName'] = 'First Name:';
$lang['settingsHintFirstName'] = '&nbsp;&nbsp;<cite>Enter your First Name. <strong>(optional)</strong> </cite>';
$lang['settingsProfileLastName'] = 'Last Name:';
$lang['settingsHintLastName'] = '&nbsp;&nbsp;<cite>Enter your Last Name. <strong>(optional)</strong></cite>';
$lang['settingsProfileLocation'] = 'Location:';
$lang['settingsHintLocation'] = '&nbsp;&nbsp;<cite>Enter your Location. <strong>(optional)</strong></cite>';
$lang['settingsProfileInterests'] = 'Interests:';
$lang['settingsHintInterests'] = '&nbsp;&nbsp;<cite>Enter your Interests. <strong>(optional)</strong></cite>';
$lang['settingsProfileOccupation'] = 'Occupation:';
$lang['settingsHintOccupation'] = '&nbsp;&nbsp;<cite>Enter your Occupation. <strong>(optional)</strong></cite>';
$lang['settingsProfileGender'] = 'Gender:';
$lang['settingsHintGender'] = '&nbsp;&nbsp;<cite>Select Your Gender. <strong>(optional)</strong></cite>';;
$lang['settingsSection4'] = 'Change Password';
$lang['settingsProfileButton'] = 'Update Settings';

// Location: modules/forums/views/changePassword.php
$lang['changePass'] = 'Change Password';
$lang['changePassOldPass'] = 'Old password: ';
$lang['changePassNewPass'] = 'New password: ';
$lang['changePassPewPassConfirm'] = 'Confirm new password: ';
$lang['changePassButton'] = 'Change Password';
$lang['oldPasswordHint'] = '<cite>Enter Your Old Password. <strong>(required)</strong> </cite>';
$lang['newPasswordHint'] = '<cite>Enter your Desired Password. <strong>(required)</strong> </cite>';
$lang['newRePasswordHint'] = '<cite>Re-Enter your Desired Password. <strong>(required)</strong> </cite>';

// Location: modules/forums/views/forgot_password.php
$lang['forgotEmailAddress'] = 'Email Address:';
$lang['hintEmailAddress'] = '&nbsp;&nbsp;<cite>Enter the email address that you used to register. <strong>(required)</strong> </cite>';
$lang['forgotPasswordButton'] = 'Recover Password';

// Location: modules/forums/views/edit_topic.php
$lang['hintDiscussionTitle'] = '&nbsp;&nbsp;<cite>Enter your Topic Title. <strong>(required)</strong> </cite>';
$lang['hintDiscussionBody'] = '&nbsp;&nbsp;<cite>Enter your Post. <strong>(required)</strong> </cite>';
$lang['hintDiscussionSticky'] = '&nbsp;&nbsp;<cite>Is Topic to be a Sticky Topic?. <strong>(optional)</strong> </cite>';
$lang['hintDiscussionClosed'] = '&nbsp;&nbsp;<cite>Is Topic to be Closed for Replys?. <strong>(optional)</strong> </cite>';

// location: modules/forums/views/sections/page_top.php
$lang['signIn'] = 'Sign In';
$lang['signOut'] = 'Sign Out';
$lang['register'] = 'Register';
$lang['guestMessage'] = 'Welcome, Stranger';
$lang['userMessage'] = 'Welcome, ';
$lang['settings'] = 'Settings';

// location: modules/forums/views/login.php
$lang['loginHeader'] = 'Sign In';
$lang['emailLabel'] = 'Email:';
$lang['passwordLabel'] = 'Password:';
$lang['loginButton'] = 'Sign In';

// Location: modules/forums/views/new_topic.php
$lang['newTopicHeader'] = 'Start a New Discussion';
$lang['section1Title'] = 'Discussion Title';
$lang['newTopicHintDiscussionTitle'] = '&nbsp;&nbsp;<cite>Enter your Topic Title. <strong>(required)</strong> </cite>';
$lang['newTopicHintDiscussionBody'] = '&nbsp;&nbsp;<cite>Enter your Post. <strong>(required)</strong> </cite>';
$lang['newTopicHintCategory'] = '&nbsp;&nbsp;<cite>Select a Category. <strong>(required)</strong> </cite>';
$lang['newTopicHintSticky'] = '&nbsp;&nbsp;<cite>Is Topic to be a Sticky Topic?. <strong>(optional)</strong> </cite>';
$lang['newTopicHintClosed'] = '&nbsp;&nbsp;<cite>Is Topic to be Closed for Replys?. <strong>(optional)</strong> </cite>';
$lang['section2Title'] = 'Category';
$lang['section3Title'] = 'Comment';
$lang['section4Title'] = 'Post Settings';
$lang['newTopicButton'] = 'Post Discussion';
$lang['newTopicDraftButton'] = 'Save Draft';
$lang['newTopicPreviewButton'] = 'Preview';
$lang['newTopicCancel'] = 'Cancel';
$lang['sticky'] = ' Sticky';
$lang['close'] = ' Close';

// Location: modules/forums/views/editPost.php
$lang['headerEditPost'] = 'Edit Post';
$lang['postNoPost'] = 'Sorry there is no post to edit!.';
$lang['updatePostButton'] = 'Update Post';
$lang['postReported'] = 'Reported';
$lang['postText'] = 'Post Text';
$lang['hintPostText'] = '&nbsp;&nbsp;<cite>Enter your post here. <strong>(required)</strong></cite>';
$lang['hintPostReported'] = '&nbsp;&nbsp;<cite>Is the Post Reported?. <strong>(optional)</strong></cite>';

// Location: modules/forums/views/edit_topic.php
$lang['editTopicHeader'] = 'Edit Discussion';
$lang['updateTopicButton'] = 'Update Discussion';

// Location: modules/forums/views/posts.php
$lang['posts'] = 'Posts: ';
$lang['postsAgo'] = 'ago';
$lang['postsDiscussionClosed'] = 'Sorry this Discussion is closed.';
$lang['postsEdit'] = 'Edit';
$lang['postsDelete'] = 'Delete';
$lang['postsReport'] = 'Report';
$lang['postsReported'] = 'Reported';
$lang['postsRemoveReport'] = 'Remove Report';
$lang['postsReportTitle'] = 'Report Post';
$lang['postsEditTitle'] = 'Edit Post';
$lang['postsDeleteTitle'] = 'Delete Post';
$lang['postsRemoveReportTitle'] = 'Remove Report';
$lang['postsQuickReply'] = 'Quick Reply';
$lang['postsAddBookmark'] = 'Add discussion to bookmarks';
$lang['postsRemoveBookmark'] = 'Remove discussion from bookmarks';
$lang['postsButtonAddBookmark'] = 'Bookmark';
$lang['postsButtonRemoveBookmark'] = 'Remove Bookmark';
$lang['postsButtonQuickReply'] = 'Quick Reply';

// Location: modules/forums/views/sections/postReply.php
$lang['createNewPost'] = 'Create a new post';
$lang['submitPostButton'] = 'Submit Post';

// Location: modules/forums/views/profile.php
$lang['profileFirstName'] = 'First Name: ';
$lang['profileLastName'] = 'Last Name: ';
$lang['profileJoined'] = 'Joined: ';
$lang['profileLastActive'] = 'Last Active: ';
$lang['profileTotalPosts'] = 'Total Posts: ';
$lang['profileLocation'] = 'Location: ';
$lang['profileInterests'] = 'Interests: ';
$lang['profileOccupation'] = 'Occupation: ';
$lang['profileGender'] = 'Gender: ';
$lang['profileSection1'] = 'User Details';

//Location: modules/forums/views/sections/toppanel.php
$lang['topWelcomeTo'] = 'Welcome to ';
$lang['topWelcome'] = 'Welcome ';
$lang['topChangePassword'] = 'Change Password';
$lang['topChangeSettings'] = 'Change Settings';
$lang['topLogout'] = 'Logout';
$lang['topMemberLogin'] = 'Member Login';
$lang['topEmail'] = 'Email: ';
$lang['topPassword'] = 'Password: ';
$lang['topUsername'] = 'Username: ';
$lang['topLogin'] = 'Login';
$lang['topRegister'] = 'Register';
$lang['topLostPassword'] = 'Lost your Password?';
$lang['topNotMember'] = 'Not a member yet? Sign Up!';

//Location: modules/forums/controllers/search
$lang['searchResults'] = 'Search Results';

//Location: modules/forums/views/sections/page_header.php
$lang['headLoginRegister'] = 'Log In | Register';
$lang['headMyAccount'] = 'My Account';
$lang['headClosePanel'] = 'Close Panel';

// Navigation
$lang['navDiscussions'] = 'Discussions';
$lang['navAdmin'] = 'Admin';

//Location: modules/forums/views/main/footer.php
$lang['copyright'] = 'Copyright &copy; Dove Forums 2011 - 2012<br>Powered By <a href="http://www.doveforums.com">Dove Forums</a> Version: 1.0.3'; 