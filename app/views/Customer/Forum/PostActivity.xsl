<!--<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>User Post Activity</title>
            </head>
            <body>
                <h2>User Post Activity Summary</h2>
                <table border="1">
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th>Likes</th>
                        <th>Comments</th>
                    </tr>
                    <xsl:for-each select="userActivity/post">
                        <tr>
                            <td><xsl:value-of select="title"/></td>
                            <td><xsl:value-of select="content"/></td>
                            <td><xsl:value-of select="date"/></td>
                            <td><xsl:value-of select="likes"/></td>
                            <td><xsl:value-of select="comments"/></td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>-->
