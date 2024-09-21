<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>
    <xsl:param name="ROOT"/>
    <xsl:template match="/">
        <html>
            <head>
                <meta charset="UTF-8"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
                      rel="stylesheet"/>
                <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"/>
                <link rel="stylesheet"
                      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
                <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
                <link rel="stylesheet"
                      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/font-awesome.min.css"
                      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
                      crossorigin="anonymous" referrerpolicy="no-referrer"/>
                <link rel="stylesheet"
                      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
            </head>
            <style>
                .summarytable { overflow: auto; width: 100%; }
                .summarytable table { border: 1px solid #dededf; height: 50%; width: 95%; margin-right:auto;
                margin-left:auto; margin-top:30px; table-layout: auto; border-collapse: collapse; border-spacing: 1px;
                text-align: left; }
                .summarytable caption { caption-side: top; text-align: left; font-size: 30px; font-weight:bold;
                margin-bottom: 10px; }
                .summarytable th { border: 1px solid #dededf; background-color: #eceff1; color: #000000; padding: 5px;
                font-size:20px;}
                .summarytable td { border: 1px solid #dededf; background-color: #ffffff; color: #000000; padding: 5px;
                font-size: 18px;}
                .total { text-align:right; font-weight: bold; padding-right:10px; text-align:center; }
            </style>

            <div class="back-btn" style="margin-top:20px; margin-left:20px;">
                <button onclick="location.href='{ROOT}/UserPurchasedTicket'" type="button" class="btn btn-primary">Go
                    Back
                </button>
            </div>

            <div class="summarytable" role="region" tabindex="0">
                <table>
                    <caption>User Ticket Summary</caption>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Ticket Status</th>
                            <th>Payment Status</th>
                            <th>Movie Title</th>
                            <th>Starting Time</th>
                            <th>Seat No</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="tickets/ticket">
                            <tr>
                                <td style="text-align:center; font-weight:bold;">
                                    <xsl:value-of select="ticketId"/>
                                </td>
                                <td>
                                    <xsl:value-of select="customerName"/>
                                </td>
                                <td>
                                    <xsl:value-of select="ticketStatus"/>
                                </td>
                                <td>
                                    <xsl:value-of select="paymentStatus"/>
                                </td>
                                <td>
                                    <xsl:value-of select="movieTitle"/>
                                </td>
                                <td>
                                    <xsl:value-of select="startingTime"/>
                                </td>
                                <td>
                                    <xsl:value-of select="seatNo"/>
                                </td>
                                <td style="text-align:center;">RM<xsl:value-of select="totalPrice"/>
                                </td>
                            </tr>
                        </xsl:for-each>
                        <tr>
                            <td colspan="7" style="font-size:25px; text-align:right; font-weight:bold;">Total Price:
                            </td>
                            <td class="total" style="font-size:25px;">
                                RM<xsl:value-of select="sum(tickets/ticket/totalPrice)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Movie Title Summary -->
                <table>
                    <caption>Summary by Movie Title</caption>
                    <thead>
                        <tr>
                            <th>Movie Title</th>
                            <th>Total Tickets Sold</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="tickets/ticket[not(movieTitle=preceding-sibling::ticket/movieTitle)]">
                            <xsl:variable name="currentTitle" select="movieTitle"/>
                            <tr>
                                <td>
                                    <xsl:value-of select="$currentTitle"/>
                                </td>
                                <td style="text-align:center;">
                                    <xsl:value-of select="count(//ticket[movieTitle=$currentTitle])"/>
                                </td>
                                <td style="text-align:center;">
                                    RM<xsl:value-of
                                        select="format-number(sum(//ticket[movieTitle=$currentTitle]/totalPrice), '#.00')"/>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>


                <!-- Date Summary -->
                <table>
                    <caption>Summary by Date</caption>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Tickets Sold</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each
                                select="tickets/ticket[not(substring-before(startingTime, ' ')=substring-before(preceding-sibling::ticket/startingTime, ' '))]">
                            <xsl:variable name="currentDate" select="substring-before(startingTime, ' ')"/>
                            <tr>
                                <td>
                                    <xsl:value-of select="$currentDate"/>
                                </td>
                                <td style="text-align:center;">
                                    <xsl:value-of
                                            select="count(//ticket[substring-before(startingTime, ' ')=$currentDate])"/>
                                </td>
                                <td style="text-align:center;">
                                    RM<xsl:value-of
                                        select="format-number(sum(//ticket[substring-before(startingTime, ' ')=$currentDate]/totalPrice), '#.00')"/>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>

                <div style="margin-top:8px; text-align:center; margin-bottom:30px;">
                    Generated from User Ticket Management Admin Page
                </div>
            </div>
        </html>
    </xsl:template>
</xsl:stylesheet>
