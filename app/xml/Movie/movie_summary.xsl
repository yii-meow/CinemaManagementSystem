<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Enhanced Movie Summary and XPath Results</title>
                <style>
                    body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
                    h1, h2, h3 { color: #333; }
                    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    .xpath-results { background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-top: 30px; }
                    .schedule-count { font-weight: bold; color: #007bff; }
                </style>
            </head>
            <body>
                <h1>Enhanced Movie Summary and XPath Results</h1>

                <h2>Movie List</h2>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Director</th>
                        <th>Duration</th>
                        <th>Category</th>
                        <th>Classification</th>
                        <th>Release Date</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Total Schedules</th>
                    </tr>
                    <xsl:apply-templates select="root/movies/movie"/>
                </table>

                <div class="xpath-results">
                    <h2>XPath Query Results</h2>

                    <h3>Total Movies</h3>
                    <p><xsl:value-of select="root/xpath_results/total_movies"/></p>

                    <h3>Category Counts</h3>
                    <table>
                        <tr>
                            <th>Category</th>
                            <th>Count</th>
                            <th>Distribution</th>
                        </tr>
                        <xsl:for-each select="root/xpath_results/category_counts/category">
                            <xsl:sort select="count" data-type="number" order="descending"/>
                            <tr>
                                <td><xsl:value-of select="name"/></td>
                                <td><xsl:value-of select="count"/></td>
                                <td>
                                    <div class="category-bar" style="width: {count div sum(../category/count) * 100}%;">
                                        <xsl:value-of select="format-number(count div sum(../category/count), '0.0%')"/>
                                    </div>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </table>

                    <h3>Language Counts</h3>
                    <table>
                        <tr>
                            <th>Language</th>
                            <th>Count</th>
                        </tr>
                        <xsl:for-each select="root/xpath_results/language_counts/language">
                            <tr>
                                <td><xsl:value-of select="name"/></td>
                                <td><xsl:value-of select="count"/></td>
                            </tr>
                        </xsl:for-each>
                    </table>

                    <h3>Average Movie Duration</h3>
                    <p><xsl:value-of select="root/xpath_results/average_duration"/> minutes</p>

                    <h3>Movies Longer Than 120 Minutes</h3>
                    <ul>
                        <xsl:for-each select="root/xpath_results/long_movies/movie">
                            <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                    </ul>

                    <h3>Popular Movies (Most Scheduled)</h3>
                    <ol>
                        <xsl:for-each select="root/xpath_results/popular_movies/movie">
                            <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                    </ol>
                </div>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="movie">
        <tr>
            <td><xsl:value-of select="title"/></td>
            <td><xsl:value-of select="director"/></td>
            <td><xsl:value-of select="duration"/> min</td>
            <td><xsl:value-of select="category"/></td>
            <td><xsl:value-of select="classification"/></td>
            <td><xsl:value-of select="releaseDate"/></td>
            <td><xsl:value-of select="language"/></td>
            <td><xsl:value-of select="status"/></td>
            <td class="schedule-count">
                <xsl:value-of select="count(schedules/schedule)"/>
            </td>
        </tr>
    </xsl:template>

</xsl:stylesheet>