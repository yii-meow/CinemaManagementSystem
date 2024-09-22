<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <style>
                    table {
                    width: 100%; /* Full width */
                    border-collapse: collapse; /* Merge borders */
                    }

                    th, td {
                    border: 1px solid #ddd; /* Border for cells */
                    padding: 8px; /* Padding inside cells */
                    text-align: left; /* Align text to the left */
                    }

                    th {
                    background-color: #f2f2f2; /* Light gray background for header */
                    color: #333; /* Dark text for header */
                    }

                    tr:nth-child(even) {
                    background-color: #f9f9f9; /* Zebra stripes for even rows */
                    }

                    tr:hover {
                    background-color: #f1f1f1; /* Highlight row on hover */
                    }

                    td[colspan] {
                    text-align: center; /* Center text in merged cells */
                    font-weight: bold; /* Make text bold for emphasis */
                    }

                    .rating-summary {
                    display: flex; /* Use flexbox for horizontal layout */
                    justify-content: space-between; /* Space out the rating counts */
                    flex-wrap: wrap; /* Allow wrapping if necessary */
                    margin-top: 10px; /* Margin above the summary */
                    padding: 10px; /* Padding around the summary */
                    border: 1px solid #ddd; /* Border around the rating section */
                    background-color: #f9f9f9; /* Light background */
                    }

                    .rating-count {
                    margin: 0 10px; /* Horizontal margin between counts */
                    flex: 1; /* Allow counts to grow and shrink */
                    min-width: 100px; /* Minimum width for each count */
                    }

                    .rating-label {
                    font-weight: bold; /* Bold for the label */
                    }

                    .rating-value {
                    font-size: 16px; /* Font size for the values */
                    color: #555; /* Color for the rating values */
                    padding-left:10px;
                    }

                </style>
            </head>
            <body>
                <h2>Feedback List</h2>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Rating</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                    <xsl:choose>
                        <xsl:when test="count(feedbacks/feedback) = 0">
                            <tr>
                                <td colspan="6" style="text-align:center;">No feedback found</td>
                            </tr>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:for-each select="feedbacks/feedback">
                                <tr>
                                    <td><xsl:value-of select="id"/></td>
                                    <td><xsl:value-of select="username"/></td>
                                    <td><xsl:value-of select="rating"/></td>
                                    <td><xsl:value-of select="content"/></td>
                                    <td><xsl:value-of select="status"/></td>
                                    <td><xsl:value-of select="created_at"/></td>
                                </tr>
                            </xsl:for-each>
                        </xsl:otherwise>
                    </xsl:choose>

                </table>

                <div class="rating-summary">
                    <div class="rating-count">
                        <span class="rating-label">5 Star rating:</span>
                        <span class="rating-value"><xsl:value-of select="count(feedbacks/feedback[rating='5'])"/></span>
                    </div>
                    <div class="rating-count">
                        <span class="rating-label">4 Star rating:</span>
                        <span class="rating-value"><xsl:value-of select="count(feedbacks/feedback[rating='4'])"/></span>
                    </div>
                    <div class="rating-count">
                        <span class="rating-label">3 Star rating:</span>
                        <span class="rating-value"><xsl:value-of select="count(feedbacks/feedback[rating='3'])"/></span>
                    </div>
                    <div class="rating-count">
                        <span class="rating-label">2 Star rating:</span>
                        <span class="rating-value"><xsl:value-of select="count(feedbacks/feedback[rating='2'])"/></span>
                    </div>
                    <div class="rating-count">
                        <span class="rating-label">1 Star rating:</span>
                        <span class="rating-value"><xsl:value-of select="count(feedbacks/feedback[rating='1'])"/></span>
                    </div>
                </div>

            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>