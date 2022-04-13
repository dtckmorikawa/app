<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="xml" omit-xml-declaration="yes" indent="yes" encoding="UTF-8"/>

<!--Root Node-->
    <xsl:template match="/">
        <bookmap xml:lang="ja-JP">
            <xsl:attribute name="id">
                <xsl:value-of select=".//@book_slug" />
            </xsl:attribute>
            <title>
                <text>
                    <xsl:value-of select=".//@book_name" />
                </text>                    
            </title>            
            <bookmeta>
                <shortdesc>
                    <xsl:value-of select=".//@book_description" />
                </shortdesc>
            </bookmeta>
            <frontmatter>
                <booklists>
                    <toc/>
                </booklists>
            </frontmatter>
            <xsl:apply-templates/>
        </bookmap>
    </xsl:template>

    <xsl:template match="ul">
        <xsl:apply-templates/>
    </xsl:template>


    <xsl:template match="li">
        <xsl:choose>
        <xsl:when test="count(ancestor::*)=2">
            <chapter>
                <xsl:attribute name="href">
                    <xsl:value-of select="concat(./@post_slug, '.html.dita')" />
                </xsl:attribute>
                <xsl:apply-templates/>
            </chapter>
        </xsl:when>
        <xsl:when test="count(ancestor::*)>3">
            <topicref>
                <xsl:attribute name="href">
                    <xsl:value-of select="concat(./@post_slug, '.html.dita')" />
                </xsl:attribute>
                <xsl:apply-templates/>
            </topicref>
        </xsl:when>        
        </xsl:choose>
    </xsl:template>

    <xsl:template match="p">
    </xsl:template>

</xsl:stylesheet>
