# Nourish Our Earth

https://www.pharmazonehc.com/
http://demos.codexcoder.com/labartisan/html/GreenForest/
color code: #f7f7f7bd
reference site
https://acti-veg.com/
* Voting Example - https://feedback.bmo.com/jfe/form/SV_eFZEWUXD6s1SknP?Q_DL=8LvzjsoJ4kdniLk_eFZEWUXD6s1SknP_CTR_brRyXRp4vdhlV6S&Q_CHL=email&Q_PopulateResponse=%7B%22QID1%22:%226%22%7D&Q_PopulateValidate=1
* Donate Example - https://www.redcross.org/donate/donation.html/

# High Level Requirements for the official website for ‘Nourish Our Earth:

REQ #1: The Title shall display the official name as “‘Nourish Our Earth”. The website shall
display the official logo of the Foundation. Scrolling items will be few recent event pics.

REQ #2: The landing page shall include Home, About, Us, Events, Publications, Members,
Sponsors and Donors, Contact us, Collaborators/ Partners …

✓ The Home Page: First sentence should summarize about what the organization
is and our goals (something unique). Mission/Vision, our goals, etc

✓ The About Us Tab: why we decided to start this organization which will catch
others attention (personal and genuine). Put pictures of our members and our
information. There should be 2 tabs (board and executive) In the members tab,

✓ Collaborator Tab: Fridays for Future, Climate Strike Canada

✓ The Publications Tab: Blog where competitions and events (pictures/videos/ etc)
are talked about

REQ #3: There shall be a “Search” option built in at the top of the website.

REQ #4: There shall be a “DONATE” button at the top of the website highlighted and bold.

REQ #5: The website shall include a built-in eCommerce system and acceptable payments
mechanism shall include “Credit Card”, “PayPal”, “Debit Card”.

✓ Payment system should create and send an automatic receipt to the donors

✓ Logs in donors’ information and total donations per users/donor

REQ#6: Members sign up system should create a profile for each member who registers and
create a master email alias with the emails of all signed up members. There should be provision
of adding members manually by the admin. Only the admin should be able to send email to this
master email alias.

REQ#7: Create a custom voting system within the website

REQ#8: Create a reunion sign-up system. Admin will only enable it whenever needed

REQ#9: Newsletter sign up field, tab, or pop up button.

REQ#10: Event should be a separate tab which has its own requirements of what we want to
do.

#db change
ALTER TABLE `vote_answers` CHANGE `answer` `answer` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

* Monthly donation 
* Newsletter Subscribe
