<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" exclude-result-prefixes="ms" xmlns:ms="urn:schemas-microsoft-com:xslt" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"  xmlns:xs="http://www.w3.org/2001/XMLSchema">
<!--<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">-->
    <xsl:output method="html"/>
 

    <xsl:template match="/">
    
        <table border="1"><tr bgcolor="#ffffff"><td>id</td><td>Название товара</td><td>Количество</td><td>Цена за аренду</td><td>Цена за закупку</td><td>Описание</td></tr>
            <xsl:for-each select="condition/str"> <!--<Что будет сортироваться>-->
            <xsl:sort order="ascending" select="ide"/><!--<По возрастанию по иду>-->
			 <xsl:sort order="descending" select="ide"/>
			 <tr bgcolor="#F5f5f5">
			 <xsl:if test="position() mod 2 = 0">
			 <xsl:attribute name="bgcolor">#ffffff</xsl:attribute>
			 </xsl:if>
			 
                
                <td><xsl:value-of select="ide"/></td>
                <td>
                 <xsl:value-of select="varname"/>
                </td>
                <td><xsl:value-of select="kolvo"/>
                </td>
              <td><xsl:value-of select="tsenaaren"/> </td>
               <td><xsl:value-of select="tsenazak"/>
                </td>
                <td><xsl:value-of select="description"/>
                </td> 
                
                </tr>
            </xsl:for-each>
        </table>
   
</xsl:template>




</xsl:stylesheet>
