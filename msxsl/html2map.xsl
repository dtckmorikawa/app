<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="xml" omit-xml-declaration="yes" indent="yes" encoding="UTF-8"/>

<!--Root Node-->
    <xsl:template match="/">
        <map xml:lang="ja-JP">
            <xsl:attribute name="id">
                <xsl:value-of select=".//@book_slug" />
            </xsl:attribute>
            <topicmeta>
                <navtitle>
                    <xsl:value-of select=".//@book_name" />
                </navtitle>
                <shortdesc>
                    <xsl:value-of select=".//@book_description" />
                </shortdesc>
            </topicmeta>
            <xsl:apply-templates/>
        </map>
    </xsl:template>

    <xsl:template match="ul">
        <xsl:apply-templates/>
    </xsl:template>


    <xsl:template match="li">
        <topicref>
            <xsl:attribute name="href">
                <xsl:value-of select="concat(./@post_slug, '.html.dita')" />
            </xsl:attribute>
            <xsl:apply-templates/>
        </topicref>
    </xsl:template>

    <xsl:template match="p">
    </xsl:template>

</xsl:stylesheet>
