The Brief
===

Create a single page application that is a ‘Lotto draw machine’.
The draw is a lotto with powerballs.

The application should be a single page with the buttons being Play button and an Export All button.
Explanation:

* There are _ number of balls in a main set of balls.

* There are _ number of balls drawn from the main set.

* There are _ number of balls in a powerball set.

* There are _ number of balls drawn from a powerball set.


* The values are set in configuration file or environment variables.. 

* When the Play button is pressed the correct number of balls are chosen from the ball set and the powerball set, this combination is displayed, showing the balls and powerball(s).

* The last 10 drawn combinations need also be shown on the screen, along with their draws time.

* The last 100 winning combinations, and their draw times need to be persisted to disk.

* When Export All is pressed then all the previous drawn combinations from the persistence store are presented to the user as a CSV file.

The program needs to be designed as one deems appropriate, other than the draw mechanism itself that needs be done in an OOP style with at minimum a public method named draw()
Apply to the best of your ability all best practices for software development.