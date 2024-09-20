<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>XPath Query Results</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    h2 { color: #333; }
                </style>
            </head>
            <body>
                <h1>XPath Query Results</h1>

                <h2>Total Movies</h2>
                <p><xsl:value-of select="xpath_results/total_movies"/></p>

                <h2>Category Counts</h2>
                <table>
                    <tr>
                        <th>Category</th>
                        <th>Count</th>
                    </tr>
                    <xsl:for-each select="xpath_results/category_counts/category">
                        <tr>
                            <td><xsl:value-of select="name"/></td>
                            <td><xsl:value-of select="count"/></td>
                        </tr>
                    </xsl:for-each>
                </table>

                <h2>Movies Longer Than 120 Minutes</h2>
                <ul>
                    <xsl:for-each select="xpath_results/long_movies/movie">
                        <li><xsl:value-of select="."/></li>
                    </xsl:for-each>
                </ul>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>