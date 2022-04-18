<!--
This file is part of the DITA Open Toolkit project.

Copyright 2006 IBM Corporation

See the accompanying LICENSE file for applicable license.
-->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:opentopic-func="http://www.idiominc.com/opentopic/exsl/function"
  xmlns:fo="http://www.w3.org/1999/XSL/Format"
  xmlns:xs="http://www.w3.org/2001/XMLSchema"
  xmlns:dita2xslfo="http://dita-ot.sourceforge.net/ns/200910/dita2xslfo"
  xmlns:dita-ot="http://dita-ot.sourceforge.net/ns/201007/dita-ot"
  exclude-result-prefixes="opentopic-func xs dita2xslfo dita-ot"
  version="2.0">
  
      <xsl:template match="*[contains(@class, ' topic/tgroup ')]" name="tgroup">
        <xsl:if test="not(@cols)">
          <xsl:call-template name="output-message">
            <xsl:with-param name="id" select="'PDFX006E'"/>
          </xsl:call-template>
        </xsl:if>

        <xsl:variable name="scale" as="xs:string?">
            <xsl:call-template name="getTableScale"/>
        </xsl:variable>

        <xsl:variable name="table" as="element()">
            <fo:table xsl:use-attribute-sets="table.tgroup">
                <xsl:call-template name="commonattributes"/>

                <xsl:call-template name="displayAtts">
                    <xsl:with-param name="element" select=".."/>
                </xsl:call-template>
		<!-- pagewide is 1 or 0 or even not specified (regardless)-->
                <xsl:if test="(parent::*/@pgwide) = '1' or (parent::*/@pgwide) = '0' or not((parent::*/pgwide))">
                    <xsl:attribute name="start-indent">0</xsl:attribute>
                    <xsl:attribute name="end-indent">0</xsl:attribute>
                    <xsl:attribute name="width">auto</xsl:attribute>
                </xsl:if>

                <xsl:apply-templates/>
            </fo:table>
        </xsl:variable>

        <xsl:choose>
            <xsl:when test="exists($scale)">
                <xsl:apply-templates select="$table" mode="setTableEntriesScale"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:copy-of select="$table"/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

</xsl:stylesheet>
