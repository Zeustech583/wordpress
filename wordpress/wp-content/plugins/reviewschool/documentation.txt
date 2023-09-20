REVIEW SCHOOL PLUGIN DOCUMENTATION
================================================================



Description
----------------------------------------------------------------
this plugin allows you to create a user account (), save a rating and list the ratings and comments of each post



Components Included
----------------------------------------------------------------
* creation_user
* rankmath_test_rest_insertion (to insert rating)
* rankmath_test_rest_endpoint (get rating)



#Creation_user
Create an unique user with role subscriber

## needed an unique user_name, password and email
## route url: example.com/api/signup/insert



#insert rating
insert a rating of one post in a database

## needed an rating and comment_ID of the comment
## route url: example.com/api/review/insert



#get rating
get comment an rating information of one post

## needed postID of the post which content the rating
## route url: example.com/api/review/get




Thank you for using reviewschool plugin