<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <style>
                .summarytable { overflow: auto; width: 100%; }
                .summarytable table { border: 1px solid #dededf; height: 50%; width: 95%; margin-right:auto; margin-left:auto; margin-top:30px; table-layout: auto; border-collapse: collapse; border-spacing: 1px; text-align: left; }
                .summarytable caption { caption-side: top; text-align: left; font-size: 30px; font-weight:bold; margin-bottom: 10px; }
                .summarytable th { border: 1px solid #dededf; background-color: #eceff1; color: #000000; padding: 5px; font-size:20px;}
                .summarytable td { border: 1px solid #dededf; background-color: #ffffff; color: #000000; padding: 5px; font-size: 18px; }
                .total { text-align:right; font-weight: bold; padding-right:10px; text-align:center; }
            </style>
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
                            <th>Username</th>
                            <th>Showtime</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="tickets/ticket">
                            <tr>
                                <td style="text-align:center; font-weight:bold;"><xsl:value-of select="ticketId"/></td>
                                <td><xsl:value-of select="customerName"/></td>
                                <td><xsl:value-of select="ticketStatus"/></td>
                                <td><xsl:value-of select="paymentStatus"/></td>
                                <td><xsl:value-of select="movieTitle"/></td>
                                <td><xsl:value-of select="startingTime"/></td>
                                <td><xsl:value-of select="seatNo"/></td>
                                <td style="text-align:center;">RM<xsl:value-of select="totalPrice"/></td>
                            </tr>
                        </xsl:for-each>
                        <tr>
                            <td colspan="7" style="font-size:25px; text-align:right; font-weight:bold;">Total Price:</td>
                            <td class="total" style="font-size:25px;">
                                RM<xsl:value-of select="sum(tickets/ticket/totalPrice)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="margin-top:8px; text-align:center; margin-bottom:30px; ">
                    Generated from User Ticket Management Admin Page
                </div>
            </div>
        </html>
    </xsl:template>
</xsl:stylesheet>