# wp-orm
ORM using Eloquent for wordpress 

##Usage example

Included models are 
- Post : Wordpress posts with post_type = post
- Page : Wordpress posts with post_type = page
- Cpt  : Wordpress posts with passed type filter
- PostMeta : Model for Wordpress postmeta table
- User : Model for Wordpress users table
- UserMeta : Model for Wordpress usermeta table
- Comments : Model for Wordpress comments table

Get all the pages and print its title

```
$pages = Page::all();
 
foreach($pages as $page) {

  var_dump($page->ID, $page->post_title);
}
 
Do not forget to include the use statement 
use XS\ORM\Model\Page;
use XS\ORM\Model\Post; 
... 
```

```
// Get all the page with its comment
$pages = Page::with('comments')->get();
 
foreach($pages as $page) {
    foreach($page->comments as $comment) {	
        var_dump($comment->comment_content);
    }
}
 
 
// Get all the page with its comments and meta's and titles includes the word "Sample"

$pages = Page::with('comments')->with('meta')->where('post_title', 'LIKE', '%Sample%')->get();
 
foreach($pages as $page) {
    foreach($page->comments as $comment) {
        var_dump($comment->comment_content);
    }
 
    foreach($page->meta as $item) {
        var_dump($item->meta_key, $item->meta_value);
    }
}
 
 
// Reading a specific post by its id
$post = Post::find(24);
 
// filter all the post by author and status and also at least one comment and order by ID
$posts = Post::status('publish')->author(5)->where('comment_count', '>=', 1)->orderBy('ID')->get();

 
```

*Cpt model points to the wordpress posts table but it does not auto filter any type,
 with this mode any type can be filtered. some examples -* 

```
// Get all the published posts
$posts = Cpt::post()->status('publish')->get();
 
// Get all the page with title having 'Sample' word
$posts = Cpt::page()->where('post_title', 'LIKE', '%Sample%')->get();
 
// Get all the page of a custom post type with its meta and comments - 
$posts = Cpt::type('xs-skeleton-plg')->with('meta')->with('comments')->get();
 
```

*You can query Post meta table directly too -*
```
// Get all the meta of post id 2
$pm = PostMeta::where('post_id', 2)->get(); OR
$pm = PostMeta::post(2)->get();
 
// Get all the meta of post id 2 and meta_key = _wp_page_template
$pm = PostMeta::post(2)->key('_wp_page_template')->get();

// If you want to return only the first row then - 
$pm = PostMeta::post(2)->first();
$pm = PostMeta::post(2)->key('_wp_page_template')->first();
 
``` 

## Creating a Model for your custom table
```
use XS\ORM\Model\XS_Model;
 
class Player extends XS_Model {

    //protected $table = 'my_player';

}
 ```
Eloquent by default takes the table name as plural form of Model name,
in this case it will point to *players* table and primary key as id column. If your table has different name then just 
`protected $table = 'table_name'` property in the model. And if primary key is not `id` then
add `protected $primaryKey = 'id';` property in the model.

``` 
// Get all players
Player::all();
// Find player by primary key value -
Player::find(5); 
// Count total active player
Player::where('active', 1)->count();
// Find highest income of active players ;
Player::where('active', 1)->max('income');
```

###Still need to run some raw query?

```
$player = DB::table('players')->where('name', 'John')->first();
echo $user->name;
 
$players = DB::table('players')->select('name', 'email as player_email')->get();
  
$players = DB::select('select * from players where active = ?', [1]);
$players = DB::select('select * from players where id = :id', ['id' => 1]);
 
DB::insert('insert into players (id, name) values (?, ?)', [1, 'Dayle']);
$affected = DB::update('update players set goal = 10 where name = ?', ['John']);
$deleted = DB::delete('delete from players');
 
DB::statement('drop table players');
  
DB::transaction(function () {
    DB::table('players')->update(['votes' => 1]);

    DB::table('posts')->delete();
});
 
$title = DB::table('roles')->pluck('title');
$roles = DB::table('roles')->pluck('title', 'name');
$price = DB::table('orders')->where('finalized', 1)->avg('price');
 
$users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get();
 
$orders = DB::table('orders')
                ->select('department', DB::raw('SUM(price) as total_sales'))
                ->groupBy('department')
                ->havingRaw('SUM(price) > 2500')
                ->get(); 
 
//Need Join ?
$users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
 
$users = DB::table('sizes')
            ->crossJoin('colours')
            ->get();
             
$users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
                                     
```
  
##How it Works
- Eloquent is mainly used here as the query builder
- WPDB is used to run queries built by Eloquent
- It doesn't create any extra MySQL connection

For more possibility check https://laravel.com/docs/5.5/queries & https://laravel.com/docs/5.5/eloquent 