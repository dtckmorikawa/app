<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:opentopic="http://www.idiominc.com/opentopic"
    xmlns:opentopic-index="http://www.idiominc.com/opentopic/index"
    xmlns:opentopic-func="http://www.idiominc.com/opentopic/exsl/function"
    xmlns:dita2xslfo="http://dita-ot.sourceforge.net/ns/200910/dita2xslfo"
    xmlns:dita-ot="http://dita-ot.sourceforge.net/ns/201007/dita-ot"
    xmlns:ot-placeholder="http://suite-sol.com/namespaces/ot-placeholder"
    exclude-result-prefixes="dita-ot ot-placeholder opentopic opentopic-index opentopic-func dita2xslfo xs"
    version="2.0">

    <!--Title numbering from https://docs.easydita.com/docs/ditaot-configs/the-dita-open-toolkit/build-a-plugin/easydita-pdf-customizations#numbering-->
    <!--With Numbering
    <xsl:template match="*" mode="getTitle">
        
        <xsl:variable name="topic" select="ancestor-or-self::*[contains(@class, ' topic/topic ')][1]" />
        <xsl:variable name="id" select="$topic/@id" />
        <xsl:variable name="mapTopics" select="key('map-id', $id)" />
        	<xsl:text> </xsl:text>
            <fo:inline>
                <xsl:apply-templates select="$mapTopics[1]" mode="topicTitleNumber"/>
            </fo:inline>
            <xsl:text> </xsl:text>
        <xsl:apply-templates />
    </xsl:template>-->

    <!--Normal getTitle template-->
    <xsl:template match="*" mode="getTitle">
        <xsl:choose>
            <xsl:when test="@spectitle">
                <xsl:value-of select="@spectitle"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <!--This template matches any bookmap chapter or any topicref -->
    <!--that's not in the frontmatter and assigns the topicTitleNumber -->
    <!--to be a count of all chapters or topicrefs (not in the frontmatter) -->
    <!--counting multiple levels of the format 1.2.3.
    <xsl:template match="*[contains(@class, ' bookmap/chapter ')] | 
	                    *[contains(@class, ' map/topicref ')]
	                     [not(ancestor-or-self::*[contains(@class,' bookmap/frontmatter ')])]"
	              mode="topicTitleNumber">
        <xsl:number format="1" 
	                count="*[contains(@class, ' map/topicref ')]
	                        [not(ancestor-or-self::*[contains(@class,' bookmap/frontmatter ')])]
	                        | *[contains(@class, ' bookmap/chapter ')]" level="multiple"/>
    </xsl:template>-->
    
    <!--Normal topicTitleNumber tempalte
        Comment out all the topicTitleNumber template
    -->

    <!--topicPrefix template with numbering-->
    <xsl:template match="*[contains(@class, ' bookmap/chapter ')] |
	                    *[contains(@class, ' bookmap/bookmap ')]/opentopic:map/
	                    *[contains(@class, ' map/topicref ')]" mode="tocPrefix">
    </xsl:template>

    <!--Normal tocPrefix template
        <xsl:template match="*[contains(@class, ' bookmap/chapter ')] |
                         *[contains(@class, ' bookmap/bookmap ')]/opentopic:map/*[contains(@class, ' map/topicref ')]" mode="tocPrefix" priority="-1">
        <xsl:call-template name="getVariable">
            <xsl:with-param name="id" select="'Table of Contents Chapter'"/>
            <xsl:with-param name="params">
                <number>
                    <xsl:apply-templates select="." mode="topicTitleNumber"/>
                </number>
            </xsl:with-param>
        </xsl:call-template>
    </xsl:template>-->
    
<!--Note Labels-->
    <xsl:template match="*" mode="placeNoteContent">
     <fo:block-container xsl:use-attribute-sets="note__container">
        <fo:block xsl:use-attribute-sets="note">
            <xsl:call-template name="commonattributes"/>
            <fo:inline xsl:use-attribute-sets="note__label">
                <xsl:choose>
                    <xsl:when test="@type='note' or not(@type)">
                        <fo:inline xsl:use-attribute-sets="note__label__note">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'note_text'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='notice'">
                        <fo:inline xsl:use-attribute-sets="note__label__notice">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Notice'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='tip'">
                        <fo:inline xsl:use-attribute-sets="note__label__tip">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Tip'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='fastpath'">
                        <fo:inline xsl:use-attribute-sets="note__label__fastpath">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Fastpath'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='restriction'">
                        <fo:inline xsl:use-attribute-sets="note__label__restriction">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Restriction'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='important'">
                        <fo:inline xsl:use-attribute-sets="note__label__important">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Important'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='remember'">
                        <fo:inline xsl:use-attribute-sets="note__label__remember">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Remember'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='attention'">
                        <!--<fo:inline xsl:use-attribute-sets="note__label__attention">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Attention'"/>
                            </xsl:call-template>
                        </fo:inline>-->
                        <fo:block xsl:use-attribute-sets="__note__imagebox">
          			<fo:external-graphic src="url(Customization/OpenTopic/common/artwork/attention.jpg)" xsl:use-attribute-sets="__note__label__size"/>
      			  </fo:block>
                    </xsl:when>
                    <xsl:when test="@type='caution'">
                        <!--<fo:inline xsl:use-attribute-sets="note__label__caution">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Caution'"/>
                            </xsl:call-template>
                        </fo:inline>-->
                        <fo:block xsl:use-attribute-sets="__note__imagebox">
          			<fo:external-graphic src="url(Customization/OpenTopic/common/artwork/caution.jpg)" xsl:use-attribute-sets="__note__label__size"/>
      			  </fo:block>
                    </xsl:when>
                    <xsl:when test="@type='danger'">
                        <fo:inline xsl:use-attribute-sets="note__label__danger">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Danger'"/>
                            </xsl:call-template>
                        </fo:inline>
                    </xsl:when>
                    <xsl:when test="@type='warning'">
                        <!--<fo:inline xsl:use-attribute-sets="note__label__danger">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Warning'"/>
                            </xsl:call-template>
                        </fo:inline>-->
                        <fo:block xsl:use-attribute-sets="__note__imagebox">
          			<fo:external-graphic src="url(Customization/OpenTopic/common/artwork/warning.jpg)" xsl:use-attribute-sets="__note__label__size"/>
      			  </fo:block>
                    </xsl:when>
                    <xsl:when test="@type='trouble'">
                      <fo:inline xsl:use-attribute-sets="note__label__trouble">
                        <xsl:call-template name="getVariable">
                          <xsl:with-param name="id" select="'Trouble'"/>
                        </xsl:call-template>
                      </fo:inline>
                    </xsl:when>                  
                    <xsl:when test="@type='other'">
                    		<fo:inline xsl:use-attribute-sets="note__label__note">
                            	<xsl:call-template name="getVariable">
 	                               <xsl:with-param name="id" select="'Note'"/>
    	                        </xsl:call-template>
        	              </fo:inline>
                        <!--<fo:inline xsl:use-attribute-sets="note__label__other">
                            <xsl:choose>
                                <xsl:when test="@othertype">
                                    <xsl:value-of select="@othertype"/>
                                </xsl:when>
                                <xsl:otherwise>
                                    <xsl:text>[</xsl:text>
                                    <xsl:value-of select="@type"/>
                                    <xsl:text>]</xsl:text>
                                </xsl:otherwise>
                            </xsl:choose>
                        </fo:inline>-->
                    </xsl:when>
                </xsl:choose>
                <!--<xsl:call-template name="getVariable">
                  <xsl:with-param name="id" select="'#note-separator'"/>
                </xsl:call-template>-->
            </fo:inline>
            <xsl:text>  </xsl:text>
            <xsl:apply-templates/>
        </fo:block>
       </fo:block-container>
    </xsl:template>


 <!--Dynamic Scaling Images -->
    <xsl:template match="*" mode="placeImage">
        <xsl:param name="imageAlign"/>
        <xsl:param name="href"/>
        <xsl:param name="height" as="xs:string?"/>
        <xsl:param name="width" as="xs:string?"/>
        <xsl:param name="scale" as="xs:string?">
            <xsl:choose>
                <xsl:when test="@scale"><xsl:value-of select="@scale"/></xsl:when>
                <xsl:when test="ancestor::*[@scale]"><xsl:value-of select="ancestor::*[@scale][1]/@scale"/></xsl:when>
            </xsl:choose>
        </xsl:param>
        <!--Using align attribute set according to image @align attribute-->
        <xsl:call-template name="processAttrSetReflection">
                <xsl:with-param name="attrSet" select="concat('__align__', $imageAlign)"/>
                <xsl:with-param name="path" select="'../../cfg/fo/attrs/commons-attr.xsl'"/>
        </xsl:call-template>
        <xsl:choose>
            <xsl:when test="(parent::*[contains(@class,' topic/fig ')]) or (parent::xref)" >
                <fo:external-graphic src="url('{$href}')" xsl:use-attribute-sets="image__block">
                        <xsl:if test="$height">
                            <xsl:attribute name="content-height">
                                <xsl:choose>
                                <xsl:when test="not(string(number($height)) = 'NaN')">
                                    <xsl:value-of select="concat($height, 'px')"/>
                                </xsl:when>
                                <xsl:otherwise>
                                    <xsl:value-of select="$height"/>
                                    </xsl:otherwise>
                                </xsl:choose>
                            </xsl:attribute>
                        </xsl:if>
                        <!--Setting image width if defined-->
                        <xsl:if test="$width">
                            <xsl:attribute name="content-width">
                                <xsl:choose>
                                <xsl:when test="not(string(number($width)) = 'NaN')">
                                    <xsl:value-of select="concat($width, 'px')"/>
                                </xsl:when>
                                <xsl:otherwise>
                                    <xsl:value-of select="$width"/>
                                </xsl:otherwise>
                                </xsl:choose>
                            </xsl:attribute>
                        </xsl:if>
                        <xsl:if test="not($width) and not($height) and $scale">
                            <xsl:attribute name="content-width">
                                <xsl:value-of select="concat($scale,'%')"/>
                            </xsl:attribute>
                        </xsl:if>
                        <xsl:if test="@scalefit = 'yes' and not($width) and not($height) and not($scale)">            
                            <xsl:attribute name="width">100%</xsl:attribute>
                            <xsl:attribute name="height">100%</xsl:attribute>
                            <xsl:attribute name="content-width">scale-to-fit</xsl:attribute>
                            <xsl:attribute name="content-height">scale-to-fit</xsl:attribute>
                            <xsl:attribute name="scaling">uniform</xsl:attribute>
                        </xsl:if>
                        <xsl:choose>
                        <xsl:when test="*[contains(@class,' topic/alt ')]">
                            <xsl:apply-templates select="*[contains(@class,' topic/alt ')]" mode="graphicAlternateText"/>
                        </xsl:when>
                        <xsl:when test="@alt">
                            <xsl:apply-templates select="@alt" mode="graphicAlternateText"/>
                        </xsl:when>
                    </xsl:choose>
          
                    <xsl:apply-templates select="node() except (text(),
                                                      *[contains(@class, ' topic/alt ') or
                                                        contains(@class, ' topic/longdescref ')])"/>
                </fo:external-graphic>
            </xsl:when>
            <xsl:otherwise>
                <fo:external-graphic src="url('{$href}')" xsl:use-attribute-sets="image__inline">
                <xsl:if test="$height">
                    <xsl:attribute name="content-height">
                        <xsl:choose>
                            <xsl:when test="not(string(number($height)) = 'NaN')">
                              <xsl:value-of select="concat($height, 'px')"/>
                            </xsl:when>
                        <xsl:otherwise>
                            <xsl:value-of select="$height"/>
                        </xsl:otherwise>
                        </xsl:choose>
                    </xsl:attribute>
                </xsl:if>
                <!--Setting image width if defined-->
                <xsl:if test="$width">
                    <xsl:attribute name="content-width">
                        <xsl:choose>
                        <xsl:when test="not(string(number($width)) = 'NaN')">
                            <xsl:value-of select="concat($width, 'px')"/>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:value-of select="$width"/>
                        </xsl:otherwise>
                        </xsl:choose>
                    </xsl:attribute>
                </xsl:if>
                <xsl:if test="not($width) and not($height) and $scale">
                    <xsl:attribute name="content-width">
                        <xsl:value-of select="concat($scale,'%')"/>
                    </xsl:attribute>
                </xsl:if>
                <xsl:if test="@scalefit = 'yes' and not($width) and not($height) and not($scale)">            
                    <xsl:attribute name="width">100%</xsl:attribute>
                    <xsl:attribute name="height">100%</xsl:attribute>
                    <xsl:attribute name="content-width">scale-to-fit</xsl:attribute>
                    <xsl:attribute name="content-height">scale-to-fit</xsl:attribute>
                    <xsl:attribute name="scaling">uniform</xsl:attribute>
                </xsl:if>
                <xsl:choose>
                    <xsl:when test="*[contains(@class,' topic/alt ')]">
                    <xsl:apply-templates select="*[contains(@class,' topic/alt ')]" mode="graphicAlternateText"/>
                </xsl:when>
                <xsl:when test="@alt">
                    <xsl:apply-templates select="@alt" mode="graphicAlternateText"/>
                </xsl:when>
                </xsl:choose>
          
                <xsl:apply-templates select="node() except (text(),
                                                      *[contains(@class, ' topic/alt ') or
                                                        contains(@class, ' topic/longdescref ')])"/>
                </fo:external-graphic>           
            </xsl:otherwise> 
        </xsl:choose>

    </xsl:template>

    <!--Added for line breaks-->
    <xsl:template match="br">
        <fo:block/>
    </xsl:template>

</xsl:stylesheet>
