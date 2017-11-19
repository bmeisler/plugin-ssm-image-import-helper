=== SSM Image Import Helper ===

== Description ==

This plugin helps you maintain better image names, titles and alt tags. It does not add anything to your database, and can be turned on an off without effect.

The problem: when importing images, Wordpress does a poor job in creating url-compliant file names and title tags, and doesn't create alt tags at all.

This plugin:

1. converts file names to url-compliant slugs, removing unsupported characters and turning all characters into lowercase. It will also convert underscores into hyphens (too many people name their images with underscores instead of hyphens) and one or more spaces into a hyphen.

2. It will maintain uppercase characters and special characters when creating the title tag - again, it will convert underscores into spaces.

3. It will automatically create an alt tag (a copy of the title tag). This might not be the best alt tag for your purposes, but at least you will always have an associated alt tag for every image, as alt tags are crucial for SEO.

For example, normally, if you import an image named "berlin_wall.jpg, it will be saved as "berlin_wall.jpg" and automatically create a title tag "berlin_wall.jpg." The url is not url compliant and the title tag is non-searchable. You will need to add an alt tag manually.

With the plugin turned on, the image would be saved as "berlin-wall.jpg" (url compliant), and the title tag would be "berlin wall" and an alt tag would automatically be created, "berlin wall."

Here's another example - we import a file named "Andy Warhol's Marilyn". Normally, the file will be saved as "Andy-Warhols_Marilyn.jpg (again, not url compliant). The title tag is "Andy Warhol's_Marilyn" (again, not very searchable). 

With the plugin turned on, the file is saved as "andy-warhols-marilyn.jpg", with a title "Andy Warhol's Marilyn" and an alt tag of "Andy Warhol's Marilyn."

So, for best results, name your images using capital letters where appropriate (eg, place or people names), and separate words using either spaces, hyphens or underscores.

Please note the plugin is not (yet) able to read minds, so if your original file is named "georgeWashingtonPresident.jpg", it will be imported as "georgeWashingtonPresident.jpg" with a title and alt tag of "georgeWashingtonPresident." That is, the plugin can't tell which words should be separate words if you don't...separate them, either with a space, a hyphen or an underscore.

This plugin will save you a minute or two every time you import a new image, will keep your images url compliant and ensure you have good titles and an alt tag for every image.