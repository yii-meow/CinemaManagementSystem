<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Movie Summary</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    table { border-collapse: collapse; width: 100%; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                </style>
            </head>
            <body>
                <h1>Movie Summary</h1>
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
                    <xsl:apply-templates select="movies/movie"/>
                </table>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="movie">
        <tr>
            <td>
                <xsl:value-of select="title"/>
            </td>
            <td>
                <xsl:value-of select="director"/>
            </td>
            <td>
                <xsl:value-of select="duration"/> min
            </td>
            <td>
                <xsl:value-of select="category"/>
            </td>
            <td>
                <xsl:value-of select="classification"/>
            </td>
            <td>
                <xsl:value-of select="releaseDate"/>
            </td>
            <td>
                <xsl:value-of select="language"/>
            </td>
            <td>
                <xsl:value-of select="status"/>
            </td>
        </tr>
    </xsl:template>
</xsl:stylesheet>