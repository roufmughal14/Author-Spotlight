# Author-Spotlight

Requrements:

Create a custom WordPress shortcode that displays a dynamic "Author Spotlight" section. The shortcode should:
1.⁠ ⁠Accept a parameter for the author's user ID
2.⁠ ⁠⁠Fetch the author's name, avatar, and bio
3.⁠ ⁠⁠Display the author's 3 most recent posts with titles and excerpt
4.⁠ ⁠⁠Show the total number of posts and comments by the author
5.⁠ ⁠⁠Include social media links if available in the user profile
6.⁠ ⁠⁠Be styled with CSS to look good out-of-the-box, but allow for theme overrides

PLUS
1. Create a repo on git 
2. Upload the code to git 
3. Update server using that code 
4. Show changes on website

Solution:

I've used theme's function.php file to create the function to dipslay Author name, Avatar, Bio, 3 recent posts, Total posts, total comments, Social media (if available).
Then I use the shortcode that I registered [author_spotlight id="2"] with author id to display the data accordingly
![image](https://github.com/user-attachments/assets/c10b4caa-d92e-4a67-8c2e-2c6f794ecc61)
