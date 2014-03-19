elite###INSERT INTO {wpr_template} ( type, typenum, content, title, comments_amazon, comments_flickr, comments_yahoo, comments_youtube, name ) VALUES  ( 'amazon', '0', '<h3><a href="{url}" rel="nofollow">{title}</a></h3>
{thumbnail}
{features}
{description}

[has_reviews]
<p>
<strong>Rating:</strong> {rating} (out of {reviewsnum} reviews)
</p>
[/has_reviews]

<p>
<div style="float:right;">{buynow-big}</div>
[has_listprice]
List Price: {listprice}
[/has_listprice]
<strong>Price: {price}</strong>
</p>', '', '0', '0', '0', '0', '' ), ( 'article', '0', '<strong>{title}</strong>
{article}
<div>{authortext}</div>', '', '', '', '', '', '' ), ( 'ebay', '0', '<strong>{title}</strong>
{descriptiontable}', '', '0', '0', '0', '0', '' ), ( 'clickbank', '0', '<strong>{title}</strong>
{description}
{link}', '', '0', '0', '0', '0', '' ), ( 'flickr', '0', '<p><strong>{title}</strong>
{image}
<i>Image by <a href="{url}">{owner}</a></i>
{description}</p>', '', '0', '0', '0', '0', 'standard' ), ( 'flickr', '0', '<div style="float:left;margin:5px;font-size:80%;">{image} by <a href="{url}">{owner}</a></div>', '', '0', '0', '0', '0', 'thumbnail' ), ( 'yahoonews', '0', '<strong>{title}</strong>
{summary}
<i>{source}</i>
', '', '0', '0', '0', '0', '' ), ( 'yahooanswers', '0', '<strong><i>Question by {user}</i>: {title}</strong>
{question}

<strong>Best answer:</strong>
{answers:1}

<strong>[select:Know better? Leave your own answer in the comments!|Add your own answer in the comments!|Give your answer to this question below!|What do you think? Answer below!]</strong>', '', '0', '0', '0', '0', '' ), ( 'youtube', '0', '{video}
<p>[random:20]<div style="float:left;margin:5px;">{thumbnail}</div>[/random]{description}
[random:60]<strong>Video Rating: {rating} / 5</strong>[/random]</p>', '', '0', '0', '0', '0', '' ), ( 'rss', '0', '{content}
{source}', '', '0', '0', '0', '0', '' ), ( 'post', '0', '{thumbnail}
{article}
[random:25]{youtube}[/random]

[random:50][select:More <a href="{catlink}">{Keyword} Articles</a>|Related <a href="{catlink}">{Keyword} Articles</a>|Find More <a href="{catlink}">{Keyword} Articles</a>][/random]', '{articletitle}', '0', '0', '0', '0', 'Article Default' ), ( 'post', '1', '{amazon}
[random:15]{amazon}[/random]
[random:50]{ebay} {ebay}[/random]

[random:50][select:More <a href="{catlink}">{Keyword} Products</a>|Related <a href="{catlink}">{Keyword} Products</a>|Find More <a href="{catlink}">{Keyword} Products</a>][/random]', '{amazontitle}[random:20] Reviews[/random]', '1', '0', '0', '0', 'Amazon Default' ), ( 'post', '2', '[random:50]{thumbnail}[/random]
{yahooanswers}', '[random:25]Q&A: [/random]{yahooanswerstitle}', '0', '0', '1', '0', 'Yahoo Answers Default' ), ( 'post', '3', '[random:25]{flickr}[/random]
{yahoonews}

{yahoonews}

[random:50]{yahoonews}[/random]

[random:25]{yahoonews}[/random]', '[select:{yahoonewstitle}|{yahoonewstitle}|Lastest {Keyword} News]', '0', '0', '0', '0', 'Yahoo News Default' ), ( 'post', '4', '[random:25]<p>[select:Check out these {keyword} products:|A few {keyword} products I can recommend:]</p>[/random]
{clickbank}

{clickbank}

[random:25]{clickbank}[/random]
[random:25] {ebay} {ebay} [/random]', '{clickbanktitle}', '0', '0', '0', '0', 'Clickbank Default' ), ( 'post', '5', '{youtube}
[random:50]{youtube}[/random]', '{youtubetitle}', '0', '0', '0', '1', 'Youtube Default' ), ( 'post', '5', '<p>[select:Some recent {keyword} auctions on eBay:|{keyword} eBay auctions you should keep an eye on:|Most popular {keyword} eBay auctions:|{Keyword} on eBay:]</p>
{ebay}
{ebay}
[random:50]{ebay}[/random]
[random:25]{ebay}[/random]', '[select:{ebaytitle}|{ebaytitle}|Lastest {Keyword} auctions|Most popular {Keyword} auctions]', '0', '0', '0', '0', 'Ebay Default' ), ( 'post', '5', '<p>[select:Some cool {keyword} images:|A few nice {keyword} images I found:|Check out these {keyword} images:]</p>
{flickr}
{flickr}
[random:50]{flickr}[/random]', '[select:{flickrtitle}|{flickrtitle}|Cool {Keyword} images|Nice {Keyword} photos]', '0', '0', '0', '0', 'Flickr Default' );