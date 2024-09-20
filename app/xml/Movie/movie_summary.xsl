<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Movie Summary and XPath Results</title>
                <style>
                    body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
                    h1, h2 { color: #333; }
                    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    .xpath-results { background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-top: 30px; }
                </style>
            </head>
            <body>
                <h1>Movie Summary and XPath Results</h1>

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
                        </tr>
                        <xsl:for-each select="root/xpath_results/category_counts/category">
                            <tr>
                                <td><xsl:value-of select="name"/></td>
                                <td><xsl:value-of select="count"/></td>
                            </tr>
                        </xsl:for-each>
                    </table>

                    <h3>Movies Longer Than 120 Minutes</h3>
                    <ul>
                        <xsl:for-each select="root/xpath_results/long_movies/movie">
                            <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                    </ul>
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
        </tr>
    </xsl:template>
</xsl:stylesheet>