GREPO=
GTYPE=f
GNAME=*.LOG
GIGNORE=i
GLIMIT=2
GSEARCH=cli
export GREP_COLORS="sl=0;33;49:ms=1;34;49"
GCOLOR="| grep --color=always '^\|[^/]*$'"
if ! [ -z $GSEARCH ] ; then GSEARCH="-exec grep -H $GSEARCH {} +" ; fi
if [ "$GIGNORE" = "i" ] ; then GIGNORE="i"
else GIGNORE= ; fi
if ! [ -z $GTYPE ] ; then GTYPE="-type $GTYPE" ; fi
if ! [ -z $GNAME ] ; then GNAME="-${GIGNORE}name $GNAME" ; fi
if [ "$GLIMIT" = "1" ] ; then GLIMIT="| head"
elif [ "$GLIMIT" = "2" ] ; then GLIMIT="| tail"
else GLIMIT= ; fi
GCMD="find $GREPO $GTYPE $GNAME $GSEARCH $GLIMIT $GCOLOR"
eval $GCMD
